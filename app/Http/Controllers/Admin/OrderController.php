<?php

namespace App\Http\Controllers\Admin;

// use DB;
use App\Models\ProductArchive;
use Illuminate\Support\Facades\DB;
use id;
use App\Models\Order;
use App\Models\Invoice;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Product::query()->with('category')->latest('id')->get();

        return view('admin.orders.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {

        if ($request->isMethod('POST')) {
            $param = $request->except('__token');

            Order::create($param);

            return redirect()
                ->route('admin.order.index')
                ->with('errors', 'Thêm thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(Order $order)
    // {
    //     $order->load(['users', 'addresses.delivery_area', 'items.product']);

    //     return view('admin.orders.show', compact('order'));
    // }

    public function show($invoiceId)
    {
        // Truy vấn Order theo invoice_id và eager load các quan hệ
        $order = Order::with([
            'users',
            'addresses.delivery_area',
            'items.product' => function ($query) {
                $query->withTrashed();
            }
        ])->where('invoice_id', $invoiceId)
          ->firstOrFail();

        return view('admin.orders.show', compact('order'));
    }



    // public function show($invoiceId)
    // {
    //     // Truy vấn Order theo invoice_id và eager load các quan hệ
    //     $order = Order::with(['users', 'addresses.delivery_area', 'items.product', 'items.productArchive'])
    //         ->where('invoice_id', $invoiceId)
    //         ->firstOrFail();

    //     foreach ($order->items as $item) {
    //         // nếu không có sản phẩm trong bảng products
    //         if (!$item->product) {
    //             // Lấy thông tin từ bảng product_archives
    //             $archivedProduct = $item->productArchive;
    //             if ($archivedProduct) {
    //                 $item->product = (object) [
    //                     'name' => $archivedProduct->name,
    //                     'thumb_image' => $archivedProduct->thumb_image,
    //                 ];
    //                 // if ($item->product->thumb_image && !Storage::exists($item->product->thumb_image)) {
    //                 //     $item->product->thumb_image = 'deleted_images/' . basename($item->product->thumb_image);
    //                 // }
    //             }
    //         }
    //     }

    //     return view('admin.orders.show', compact('order'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);

        return view(
            'admin.orders.update',
            compact('order')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $param = $request->except('__token', '__method');
            $orders = Order::findOrFail($id);

            $orders->update($param);

            return redirect()
                ->route('admin.orders.index')
                ->with('errors', 'Sửa thành công');
        }
    }

    public function updateStatus(UpdateOrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'order_status' => 'required|in:pending,processing,completed,canceled',
        ]);

        $order->order_status = $request->order_status;
        $order->save();

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật thành công.');
    }

    public function cancel(Order $order)
    {
        try {
            DB::beginTransaction();

            // Kiểm tra trạng thái đơn hàng
            if (in_array($order->order_status, ['processing'])) {
                return redirect()->back()->with('error', 'Đơn hàng "Đang Được Giao", không thể hủy.');
            } elseif (in_array($order->order_status, ['completed'])) {
                return redirect()->back()->with('error', 'Đơn hàng "Đã Hoàn Thành", không thể hủy.');
            } elseif (in_array($order->order_status, ['canceled'])) {
                return redirect()->back()->with('error', 'Đơn hàng "Đã Bị Hủy", không thể hủy lần nữa.');
            }

            // Cập nhật trạng thái đơn hàng
            $order->update([
                'order_status' => 'canceled',
                'updated_at' => now(),
            ]);

            // Cập nhật lại stock nếu cần (tuỳ vào nghiệp vụ)
            // foreach ($order->orderItems as $item) {
            //     $item->product->increment('stock', $item->quantity);
            // }

            DB::commit();
            return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi hủy đơn hàng: ' . $e->getMessage());
        }
    }
}
