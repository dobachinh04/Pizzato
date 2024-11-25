<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
            'totalViews' => $this->getTotalViews(),
            'totalReviews' => $this->getTotalReviews(),
            'reviews' => $this->getRecentReviews(),
            'ratingPercentages' => $this->calculateRatingPercentages(),
            'averageRating' => $this->calculateAverageRating(),
            'pendingOrders' => $this->getPendingOrders(),
            'lowStockProducts' => $this->getLowStockProducts(),
            'orderOvers' => $this->getPendingOrdersOver30Minutes(),
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
    }

    private function getTotalViews()
    {
        return Product::sum('view');
    }

    private function getTotalReviews()
    {
        return ProductReview::count();
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
        return Product::where('qty', '<', 10)
            ->select('id', 'name', 'thumb_image', 'qty')
            ->get();
    }

    private function getPendingOrdersOver30Minutes()
    {
        $orderOvers = DB::table('orders')
            ->where('order_status', 'pending')
            ->where('created_at', '<=', Carbon::now()->subMinutes(30))
            ->get();

        foreach ($orderOvers as $order) {
            $order->time_ago = Carbon::parse($order->created_at)->diffForHumans();
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
}
