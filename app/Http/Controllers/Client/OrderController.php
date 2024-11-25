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
            ->with(['users', 'addresses'])
            ->get();

        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }

    public function show($orderId)
    {
        $order = Order::with(['items.product'])->findOrFail($orderId);
        $items = $order->items;

        return view('client.order_history.show', compact('order', 'items'));
    }

}
