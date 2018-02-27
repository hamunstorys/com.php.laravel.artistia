<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    public function editArtist()
    {
        $code = Input::get('Code');
        $mobnum = Input::get('MobNumber');

        return Response::json(['status' => true, 'message' => 'OTP has been sent to your mobile number']);
    }
}
