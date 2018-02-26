<?php

namespace App\Http\Controllers\Star;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function __construct()
    {

    }

    public function error(Request $request)
    {
        $alert = array(
            'message' => $request->message,
            'alert-type' => 'error',
            'positionClass' => 'toast-top-center',
        );
        $route = $request->route;
        session()->put('notification', $alert);
        return redirect(route($route));
    }

    public function confirm(Request $request)
    {
        $alert = array(
            'message' => $request->message,
            'alert-type' => 'confirm',
            'positionClass' => 'toast-top-center',
            "tapToDismiss" => false,
        );
        $route = $request->route;
        session()->put('notification', $alert);
        return redirect(route($route));
    }
}
