<?php

namespace App\Console\Commands;

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderPendingNotification;
use Illuminate\Notifications\AnonymousNotifiable;

class CheckPendingOrders extends Command
{
    protected $signature = 'orders:check-pending';
    protected $description = 'Kiểm tra các đơn hàng chưa được thanh toán quá 30 phút và 1 giờ';

    public function handle()
    {
        $now = Carbon::now();

        // Lấy đơn hàng đã tạo từ 30 phút trước và vẫn ở trạng thái 'pending'
        $orders30Minutes = Order::where('created_at', '<=', $now->subMinutes(30))
            ->where('order_status', 'pending')
            ->whereNull('notification_sent_30')
            ->get();

        // Lấy đơn hàng đã tạo từ 1 giờ trước và vẫn ở trạng thái 'pending'
        $orders1Hour = Order::where('created_at', '<=', $now->subHour())
            ->where('order_status', 'pending')
            ->whereNull('notification_sent_60')
            ->get();

        // Gửi thông báo cho admin
        foreach ($orders30Minutes as $order) {
            $this->notifyAdmin($order, 'alert', 'Đơn hàng chưa được thanh toán sau 30 phút.');
            $order->update(['notification_sent_30' => $now]);
        }

        foreach ($orders1Hour as $order) {
            $this->notifyAdmin($order, 'alert', 'Đơn hàng chưa được thanh toán sau 1 giờ.');
            $order->update(['notification_sent_60' => $now]);
        }
    }

    // protected function notifyAdmin($order, $type, $message)
    // {

    //     // $admin = User::where('is_admin', true)->first();
    //     // if ($admin) {
    //     //     $admin->notify(new OrderPendingNotification($message));
    //     // }
    //      // Gửi thông báo vào bảng notifications
    //      Notification::sendNow(
    //         new AnonymousNotifiable(),
    //         new OrderPendingNotification($message)
    //     );
    // }
    protected function notifySystem($order, $message)
    {
        Notification::sendNow(
            new AnonymousNotifiable(), // Tạm thời sử dụng AnonymousNotifiable
            new OrderPendingNotification($message)
        );
    }
}
