<?php

namespace App\Http\Controllers\Client;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->get('user_id');
        $orders = Order::where('user_id', $userId)
            ->with(['users', 'addresses', 'items.product'])
            ->get();

        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }

    public function detailOrder($orderId)
    {
        $order = Order::where('id', $orderId)
            ->with(['users', 'addresses', 'items.product'])
            ->first();

        return response()->json([
            'success' => true,
            'order' => $order
        ]);
    }

    public function cancelOrder(String $id)
    {
        $order = Order::findOrFail($id);

        $order->update(['order_status' => 'canceled']);

        return response()->json([
            'success' => true,
            'message' => 'Đơn hàng thành công',
        ]);
    }
}
