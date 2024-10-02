<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlaced extends Notification implements ShouldQueue
{
    use Queueable;

    public $orders;
    public function __construct($order)
    {
        $this->orders = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        $order = Order::with('orderitems')->where('id', $this->orders->id)->first();
        return (new MailMessage)
                ->subject('Order Placed')
                ->markdown('emails.OrderPlaced', ['order' => $order, 'user'=>$notifiable, 'url'=> env('APP_URL').'/orderhistory' ]);

    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

}
