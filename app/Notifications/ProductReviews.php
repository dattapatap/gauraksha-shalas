<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ProductReviews extends Notification implements ShouldQueue
{
    use Queueable;

    public $product;

    public function __construct( $prodcut)
    {
        $this->product = $prodcut;
    }



    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'header' =>'New Project Review Posted',
            'category' => "Review",
            'data' => 'Please check the review and publish',
            'link'=> env('APP_URL').'/admin/products/'.$this->product,
        ];
    }

}
