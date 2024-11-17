<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    // Phương thức hiển thị thống kê tổng quát
    public function index()
    {
        $productCount = Product::count(); // Đếm số sản phẩm
        $orderCount = Order::count(); // Đếm số đơn hàng
        $revenue = Order::sum('grand_total'); // Tính tổng doanh thu
        $totalViews = Product::sum('view'); // Tính tổng lượt xem sản phẩm 

        return view('admin.dashboard', compact('productCount', 'orderCount', 'revenue', 'totalViews'));
    }

    // Phương thức thống kê doanh thu theo tháng
    public function chart(Request $request)
    {
        //lấy date_rangetham số từ yêu cầu. Nếu tham số không có, mặc định là tháng hiện tại
        $dateRange = $request->input('date_range', now()->format('Y-m')); // Lấy khoảng thời gian từ request
        //lấy tổng doanh thu cho mỗi tháng trong phạm vi ngày đã chỉ định (hoặc tháng hiện tại nếu không cung cấp phạm vi ngày). 
        //Các kết quả được nhóm theo tháng và sắp xếp theo thứ tự thời gian.
        $revenueStats = Order::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('SUM(grand_total) as total_revenue'))
            ->where('created_at', 'like', "$dateRange%")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.chart', compact('revenueStats'));
    }

    // Phương thức thống kê nguồn doanh thu
    public function source(Request $request)
    {
        $dateRange = $request->input('date_range', now()->format('Y-m'));
        $sourceStats = Order::with('items.product.category')//tự động tải dữ liệu liên quan cho các mô hình items, product, và category.
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
