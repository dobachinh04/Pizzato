<?php

namespace App\Http\Controllers\Client;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index($userId)
    {
        // Lấy tất cả đơn hàng theo user_id và tải các quan hệ liên quan
        $orders = Order::where('user_id', $userId)
            ->with(['users','addresses'])
            ->get();

            return view('client.order_history.index', compact('orders'));

    }
}
