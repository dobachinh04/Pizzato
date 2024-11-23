<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // Phương thức hiển thị thống kê tổng quát
    public function index()
    {
        $productCount = Product::count(); // Đếm số sản phẩm
        $orderCount = Order::count(); // Đếm số đơn hàng
        $revenue = Order::sum('grand_total'); // Tính tổng doanh thu
        $totalViews = Product::sum('view'); // Tính tổng lượt xem sản phẩm 
        $totalReviews = ProductReview::count();

        $reviews = ProductReview::with(['user', 'product'])
          ->latest()
          ->take(4)  // Lấy 4 đánh giá mới nhất
          ->get();
          return view('admin.dashboard', compact('productCount', 'orderCount','reviews', 'revenue', 'totalViews'));
      
        // Lấy số lượng đánh giá theo từng mức sao (1 đến 5 sao)
        $ratingsCount = ProductReview::select(DB::raw('rating, COUNT(*) as count'))
            ->groupBy('rating')
            ->get()
            ->keyBy('rating'); // Tạo một mảng với key là rating (1-5)

        // Tính tỷ lệ phần trăm cho từng mức sao
        $ratingPercentages = [];
        foreach ([5, 4, 3, 2, 1] as $rating) {
            $count = $ratingsCount->get($rating)->count ?? 0;
            $percentage = $totalReviews ? ($count / $totalReviews) * 100 : 0;
            $ratingPercentages[$rating] = [
                'count' => $count,
                'percentage' => $percentage,
            ];
        }

        // Tính điểm trung bình của tất cả các đánh giá
        $averageRating = ProductReview::avg('rating');

        // Lấy ra đơn hàng mới nhất chưa xử lý (trạng thái pending)
        $pendingOrders = Order::with('addresses')
            ->select(
                'orders.invoice_id', // Lấy cột invoice_id từ bảng orders.
                'addresses.first_name',
                'addresses.last_name',
                'orders.grand_total',
                'orders.payment_status',
                'orders.order_status',
                'orders.created_at'
            )
            ->join('addresses', 'orders.address_id', '=', 'addresses.id') // join 2 bảng address và order
            ->where('orders.order_status', 'pending')
            ->orderByDesc('orders.created_at') // Sắp xếp kết quả theo thứ tự giảm dần của cột created_at trong bảng orders.
            ->get();

        // Lấy danh sách sản phẩm có quantity dưới 10
        $lowStockProducts = Product::where('qty', '<', 10)
            ->select('id', 'name', 'thumb_image', 'qty')
            ->get();

        return view('admin.dashboard', compact(
            'productCount', 'orderCount', 'revenue', 'totalViews',
            'totalReviews', 'ratingPercentages', 'averageRating', 'pendingOrders', 'lowStockProducts'
        ));
    }

    // Phương thức thống kê doanh thu theo tháng
    public function chart(Request $request)
    {
        // Thống kê doanh thu theo tháng
        $revenueStats = [];
        for ($i = 1; $i <= 12; $i++) {
            // Lọc các bản ghi trong bảng orders dựa trên tháng
            $totalRevenue = Order::whereMonth('created_at', $i)
                ->whereYear('created_at', date('Y')) // Lọc các bản ghi theo năm
                ->sum('grand_total');

            $revenueStats[] = [
                'month' => $i,
                'total_revenue' => $totalRevenue,
            ];
        }

        return view('admin.chart', compact('revenueStats'));
    }

    // Phương thức thống kê nguồn doanh thu
    public function source(Request $request)
    {
        $dateRange = $request->input('date_range', now()->format('Y-m'));
        $sourceStats = Order::with('items.product.category') // Tự động tải dữ liệu liên quan cho các mô hình items, product, và category.
            ->select(DB::raw('categories.name as category_name, SUM(order_items.qty * order_items.unit_price) as total_revenue'))
            // Nối orders bảng với order_items bảng trên id
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            // Lọc các bản ghi có created_at cột trong orders bảng bắt đầu bằng giá trị $dateRange
            ->where('orders.created_at', 'like', "$dateRange%")
            ->groupBy('categories.name')
            ->get();

        return view('admin.source', compact('sourceStats'));
    }

    // Phương thức lấy thông báo đơn hàng chưa xử lý
    // public function getPendingOrderNotification()
    // {
    //     $unreadAlerts = Auth::user()->unreadNotifications()
    //         ->where('type', 'App\Notifications\OrderPendingNotification')
    //         ->get();

    //     return view('admin.dashboard', compact('unreadAlerts'));
    // }
}
