<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeUser extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;

    public function __construct()
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {

    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }





}
