<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductReview;
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

        $totalReviews = ProductReview::count();

        // Lấy số lượng đánh giá theo từng mức sao (1 đến 5 sao)
        $ratingsCount = ProductReview::select(DB::raw('ROUND(rating) as rounded_rating, COUNT(*) as count'))
            ->groupBy('rounded_rating')
            ->get()
            ->keyBy('rounded_rating'); // Tạo key là số sao làm tròn

        // Tính tổng số sao
        $totalStars = 0;
        foreach ($ratingsCount as $rating => $data) {
            $totalStars += $rating * $data->count; // Tích số sao và số lượng
        }

        // Tính điểm trung bình (dựa trên tổng số sao và tổng số đánh giá)
        $averageRating = $totalReviews ? $totalStars / $totalReviews : 0;
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

        return view('admin.dashboard', compact(
            'productCount',
            'orderCount',
            'revenue',
            'totalViews',
            'totalReviews',
            'ratingPercentages',
            'averageRating'
        ));
    }

    // Phương thức thống kê doanh thu theo tháng
    public function chart(Request $request)
    {
        // Thống kê doanh thu theo tháng
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

        return view('admin.chart', compact('revenueStats'));
    }

    // Phương thức thống kê nguồn doanh thu
    public function source(Request $request)
    {
        $dateRange = $request->input('date_range', now()->format('Y-m'));
        $sourceStats = Order::with('items.product.category') //tự động tải dữ liệu liên quan cho các mô hình items, product, và category.
            //lấy tên danh mục và tổng doanh thu (được tính bằng tổng số lượng nhân với đơn giá) cho từng danh mục.
            ->select(DB::raw('categories.name as category_name, SUM(order_items.qty * order_items.unit_price) as total_revenue'))
            //nối ordersbảng với order_items bảng trên id
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            //lọc các bản ghi có created_atcột trong ordersbảng bắt đầu bằng giá trị $dateRange
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('orders.created_at', 'like', "$dateRange%")
            //nhóm các kết quả theo tên danh mục.
            ->groupBy('categories.name')
            ->get();

        return view('admin.source', compact('sourceStats'));
    }
}
