<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

// class OrderPendingNotification extends Notification
// {
//     use Queueable;

//     protected $order;

//     public function __construct($order)
//     {
//         $this->order = $order;

//     }

//     public function via($notifiable)
//     {
//         // Gửi thông  vào database
//         return [ 'database'];
//     }

//     public function toMail($notifiable)
//     {
//         return (new MailMessage)
//             ->subject('Đơn hàng chưa được thanh toán')
//             ->line('Đơn hàng #' . $this->order->invoice_id . ' chưa được thanh toán.')
//             ->action('Xem chi tiết', url('/admin/orders/' . $this->order->id));
//     }

//     public function toArray($notifiable)
//     {
//         return [
//             'order_id' => $this->order->id,
//             'invoice_id' => $this->order->invoice_id,
//             'message' => 'Đơn hàng chưa được thanh toán trong thời gian quy định.',
//         ];
//     }
// }

class OrderPendingNotification extends Notification
{
    use Queueable;

    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];  // Lưu thông báo vào bảng notifications
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
        ];
    }
}

