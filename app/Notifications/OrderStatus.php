<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatus extends Notification implements ShouldQueue
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
        return (new MailMessage)
                ->subject('Order Update')
                ->markdown('emails.OrderStatus', ['order' => $this->orders, 'user'=>$notifiable, 'url'=> env('APP_URL').'/orderhistory' ]);
    }

}
