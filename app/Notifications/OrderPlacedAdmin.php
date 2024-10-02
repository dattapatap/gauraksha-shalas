<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlacedAdmin extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $order;

    public function __construct( $order, $user)
    {
        $this->user = $user;
        $this->order = $order;
    }



    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toArray($notifiable)
    {
        return [
            'header' =>'New Order has been placed',
            'category' => "Order",
            'data' => 'Please check the new order and take the action',
            'link'=> env('APP_URL').'/admin/orders/all',
        ];
    }


    public function toMail($notifiable)
    {
        $order = Order::with('orderitems')->where('id', $this->order->id)->first();

        return (new MailMessage)
                ->subject('New Order Placed')
                ->markdown('emails.OrderPlacedAdmin', ['order' => $order, 'user'=>$notifiable, 'url'=> env('APP_URL').'/admin/orders/all' ]);
    }




}
