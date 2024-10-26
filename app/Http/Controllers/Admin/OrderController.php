<?php

namespace App\Http\Controllers\Admin;

use id;
use App\Models\Order;
use App\Models\Invoice;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;

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
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
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
    public function update(UpdateOrderRequest $request, String $id)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $orders = Order::findOrFail($id);

        $orders->delete();

        return redirect()
            ->route('admin.order.index')
            ->with('errors', 'Xóa thành công');
    }

    public function deleted()
    {
        $orders = Order::get();
        return view('admin.orders.index', compact('orders'));
    }
}
