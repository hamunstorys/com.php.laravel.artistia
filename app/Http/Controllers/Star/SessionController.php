<?php

namespace App\Http\Controllers\Star;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('destroy');
    }

    public function create()
    {
        return view('star.session.create');
    }

    public function store(Request $request)
    {

        if (!auth()->attempt($request->only('email', 'password'), $request->has('remember'))) {
            $notification = array(
                'message' => '로그인 정보가 잘 못 되었습니다.',
                'alert-type' => 'error',
            );
            session()->put('notification', $notification);
            return back();
        }
        return redirect()->route('star.index');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect()->route('star.index');
    }
}