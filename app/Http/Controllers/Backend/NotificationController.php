<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function index(Request $request){
        if(isset( Auth::guard('admin')->user()->id )){
            $notification = DatabaseNotification::where('notifiable_id', Auth::guard('admin')->user()->id)->orderBy('created_at',"DESC")->get();
            return view('backend.notifications.index',  compact('notification'));
        }
        abort(403, 'Unauthorized action.');
    }

    public function markAsRead(Request $request)
    {
        if($request->post('id')){
            auth()->guard('admin')->user()->unreadNotifications->where('id', $request->post('id'))->markAsRead();
            return response()->json(["success", "Marked as read"]);
        }else{
            auth()->guard('admin')->user()->unreadNotifications->markAsRead();
            return response()->json(["success", "Marked as read"]);
        }
    }

}
