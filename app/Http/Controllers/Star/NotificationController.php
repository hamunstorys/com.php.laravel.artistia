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
    {r
        $alert = array(
            'message' => $request->message,
            'alert-type' => 'error',
            'positionClass' => 'toast-top-center',
        );
        $route = $request->route;
        session()->put('notification', $alert);
        return redirect()->route($route);
    }

    public function warning(Request $request)
    {
        $alert = array(
            'message' => $request->message,
            'alert-type' => 'warning',
            'positionClass' => 'toast-top-center',
        );
        $route = $request->route;
        session()->put('notification', $alert);
        return redirect()->route($route);
    }
}
