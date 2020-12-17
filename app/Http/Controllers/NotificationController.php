<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Exception;

class NotificationController extends Controller
{
    /**
     * Display a listing of the notifications.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('notifications.index');
    }

    /**
     * Display the specified
     *
     * @param  int  $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $notification = Notification::findOrFail($id);

        return view('notifications.show', compact('notification'));
    }

}
