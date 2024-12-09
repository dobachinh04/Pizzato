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

    public function cancelOrder(string $id)
    {
        $order = Order::findOrFail($id);

        // Kiểm tra nếu trạng thái đơn hàng là processing hoặc completed
        if (in_array($order->order_status, ['processing', 'completed'])) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể hủy đơn hàng đang xử lý hoặc đã hoàn thành.',
            ], 400); // HTTP status code 400: Bad Request
        }

        // Cập nhật trạng thái đơn hàng thành canceled
        $order->update(['order_status' => 'canceled']);

        return response()->json([
            'success' => true,
            'message' => 'Đơn hàng đã được hủy thành công.',
        ]);
    }
}
