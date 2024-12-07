<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\NotifyDelayOrderRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'productCount' => $this->getProductCount(),
            'orderCount' => $this->getOrderCount(),
            'revenue' => $this->getTotalRevenue(),
            'profit' => $this->getTotalProfit(),
            'totalViews' => $this->getTotalViews(),
            'totalReviews' => $this->getTotalReviews(),
            'reviews' => $this->getRecentReviews(),
            'ratingPercentages' => $this->calculateRatingPercentages(),
            'averageRating' => $this->calculateAverageRating(),
            'pendingOrders' => $this->getPendingOrders(),
            'lowStockProducts' => $this->getLowStockProducts(),
            'orderOvers' => $this->getPendingOrdersOver30Minutes(),
            'products' => $this->getTopViewedProducts(),

        ]);
    }

    private function getProductCount()
    {
        return Product::count();
    }

    private function getOrderCount()
    {
        return Order::count();
    }

    private function getTotalRevenue()
    {

        return Order::sum('grand_total');
        // return DB::table('orders')
        // ->where('order_status', 'completed')
        // ->sum('grand_total');
    }
    private function getToTalProfit(){
        return DB::table('orders')
        ->where('order_status', 'completed')
        ->sum('grand_total');
    }

    private function getTotalViews()
    {
        return Product::sum('view');
    }

    private function getTotalReviews()
    {
        return ProductReview::count();
    }

    public function getTopViewedProducts($limit = 10)
    {
        // Lấy danh sách sản phẩm nhiều lượt xem nhất
        $products = Product::select('id', 'name', 'view', 'slug', 'thumb_image')
            ->orderByDesc('view') // Sắp xếp theo số lượt xem giảm dần
            ->limit($limit) // Giới hạn số lượng sản phẩm
            ->get();

        return $products;  // Trả về sản phẩm
    }

    private function getRecentReviews()
    {
        return ProductReview::with(['user', 'product'])
            ->latest()
            ->take(4)
            ->get();
    }

    private function calculateRatingPercentages()
    {
        $ratingsCount = ProductReview::select(DB::raw('ROUND(rating) as rounded_rating, COUNT(*) as count'))
            ->groupBy('rounded_rating')
            ->get()
            ->keyBy('rounded_rating');

        $totalReviews = $this->getTotalReviews();
        $ratingPercentages = [];

        foreach ([5, 4, 3, 2, 1] as $rating) {
            $count = $ratingsCount->get($rating)->count ?? 0;
            $percentage = $totalReviews ? ($count / $totalReviews) * 100 : 0;
            $ratingPercentages[$rating] = [
                'count' => $count,
                'percentage' => round($percentage, 2),
            ];
        }

        return $ratingPercentages;
    }

    private function calculateAverageRating()
    {
        $ratingsCount = ProductReview::select(DB::raw('ROUND(rating) as rounded_rating, COUNT(*) as count'))
            ->groupBy('rounded_rating')
            ->get()
            ->keyBy('rounded_rating');

        $totalReviews = $this->getTotalReviews();
        $totalStars = 0;

        foreach ($ratingsCount as $rating => $data) {
            $totalStars += $rating * $data->count;
        }

        return $totalReviews ? round($totalStars / $totalReviews, 1) : 0;
    }

    private function getPendingOrders()
    {
        return Order::with('addresses')
            ->select(
                'orders.id', // Thêm cột ID để sử dụng trong route
                'orders.invoice_id',
                'addresses.first_name',
                'addresses.last_name',
                'orders.grand_total',
                'orders.payment_status',
                'orders.order_status',
                'orders.created_at'
            )
            ->join('addresses', 'orders.address_id', '=', 'addresses.id')
            ->where('orders.order_status', 'pending')
            ->orderByDesc('orders.created_at')
            ->get();
    }

    private function getLowStockProducts()
    {
        return Product::where('qty', '<=', 10)
            ->select('id', 'name', 'thumb_image', 'qty')
            ->get();
    }

    // lấy thông báo đơn hàng chưa xử lý quá 30 phút
    private function getPendingOrdersOver30Minutes()
    {
        // Lấy danh sách đơn hàng quá hạn
        $orderOvers = DB::table('orders')
            ->where('order_status', 'pending')
            ->where('created_at', '<=', Carbon::now()->subMinutes(20))
            ->get();


        foreach ($orderOvers as $order) {
            // Tính toán thời gian "bao nhiêu phút trước"
            $order->time_ago = Carbon::parse($order->created_at)->diffForHumans();

            // Kiểm tra xem thông báo cho đơn hàng này đã tồn tại và chưa bị xoá (xoá cứng)
            $existingNotification = DB::table('notifications')
                ->where('type', 'order_overdue')
                ->where('reference_id', $order->invoice_id)
                // ->whereNull('deleted_at') // Chỉ lấy những thông báo chưa bị xóa mềm
                ->first();


            // Chỉ tạo thông báo nếu chưa có thông báo tương ứng
            // Nếu thông báo chưa tồn tại
            if (!$existingNotification) {
                // Tạo thông báo tùy thuộc vào trạng thái của đơn hàng
                $message = '';

                if ($order->order_status === 'pending') {
                    $message = "Đơn hàng #{$order->invoice_id} chưa được xử lý.";
                }

                if ($order->payment_status === 'pending') {
                    $message = "Đơn hàng #{$order->invoice_id} chưa được thanh toán.";
                } elseif ($order->payment_status === 'failed') {
                    $message = "Đơn hàng #{$order->invoice_id} thanh toán thất bại.";
                }
                // 'message' => "Đơn hàng #{$order->invoice_id} đã quá hạn thanh toán {$order->time_ago}."
                // Chỉ tạo thông báo nếu message không rỗng
                if (!empty($message)) {
                    DB::table('notifications')->insert([
                        'type' => 'order_overdue', // Loại thông báo
                        'reference_id' => $order->invoice_id, // ID của đơn hàng liên quan
                        'message' => $message,
                        'is_read' => false, // Thông báo mặc định là chưa đọc
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        return $orderOvers;
    }

    public function chart(Request $request)
    {
        $revenueStats = $this->getMonthlyRevenueStats();
        return view('admin.chart', compact('revenueStats'));
    }

    private function getMonthlyRevenueStats()
    {
        $revenueStats = [];
        for ($i = 1; $i <= 12; $i++) {
            $totalRevenue = Order::whereMonth('created_at', $i)
                ->whereYear('created_at', date('Y'))
                ->sum('grand_total');

            $revenueStats[] = [
                'month' => $i,
                'total_revenue' => $totalRevenue,
            ];
        }

        return $revenueStats;
    }

    public function source(Request $request)
    {
        $sourceStats = $this->getSourceRevenueStats($request->input('date_range', now()->format('Y-m')));
        return view('admin.source', compact('sourceStats'));
    }

    private function getSourceRevenueStats($dateRange)
    {
        return Order::with('items.product.category')
            ->select(DB::raw('categories.name as category_name, SUM(order_items.qty * order_items.unit_price) as total_revenue'))
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('orders.created_at', 'like', "$dateRange%")
            ->groupBy('categories.name')
            ->get();
    }

    public function notifyOrder(Request $request)
    {


        // Lấy nội dung thông báo
        $message = $request->input('message') === 'Khác'
            ? $request->input('message_custom')
            : $request->input('message');


        // Nếu chọn "Khác", lấy nội dung từ solution_custom
        // Lấy nội dung cách giải quyết
        $solution = $request->input('solution') === 'Khác'
            ? $request->input('solution_custom')
            : $request->input('solution_custom') ?? $request->input('solution');
        // Lưu vào bảng delay_notifications
        DB::table('delay_notifications')->insert([
            // 'id' => $request->input('order_id'),
            'invoice_id' => $request->input('invoice_id'),
            'reason' => $message,
            'solution' => $solution, // Hiện tại chưa cần solution
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect lại trang với thông báo thành công
        return redirect()->back()->with('success', 'Thông báo đã được gửi thành công!');
    }
}
