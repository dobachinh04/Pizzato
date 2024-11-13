<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

     // Phương thức hiển thị thống kê tổng quát
    public function index()
    {
        $productCount = Product::count(); // Đếm số sản phẩm
        $orderCount = Order::count(); // Đếm số đơn hàng
        $revenue = Order::sum('grand_total'); // Tính tổng doanh thu
        $totalViews = Product::sum('view'); // Tính tổng lượt xem sản phẩm (giả sử có trường 'views')

        return view('admin.dashboard', compact('productCount', 'orderCount', 'revenue', 'totalViews'));

    }

}
