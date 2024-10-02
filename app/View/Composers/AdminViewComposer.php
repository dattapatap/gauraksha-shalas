<?php

namespace App\View\Composers;

use App\Models\Setting;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminViewComposer
{
    public function compose(View $view)
    {
        $user = Auth::guard('admin')->user();
        if(isset($user->id)){
            $notifications = DatabaseNotification::where('notifiable_id', $user->id)
                                ->orderBy('created_at',"DESC")
                                ->groupBy('type')
                                ->groupBy('read_at')
                                ->select()
                                ->addSelect(DB::raw('count(*) as total'))
                                ->limit(15)->get();

            $unreadNotf = DatabaseNotification::where('notifiable_id',  $user->id)
                                        ->orderBy('created_at',"DESC")
                                        ->groupBy('type')
                                        ->where('read_at',null)->count();

            $view->with('notifications', $notifications);
            $view->with('unreadNotf', $unreadNotf);
        }else{
            $view->with('notifications', null);
            $view->with('unreadNotf', null);
        }

    }
}

