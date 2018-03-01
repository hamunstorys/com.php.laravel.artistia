<?php

namespace App\Http\Controllers\Star;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $user = DB::table('star_users')->where('email', "=", $request->email)->first();
        if ($user == null) {
            return \response()->json(['success' => false, 'message' => '아이디가 없습니다.'], Response::HTTP_OK);
        } else {
            if (!auth()->attempt($request->only('email', 'password'))) {
                return \response()->json(['success' => false, 'message' => '비밀번호가 틀렸습니다.'], Response::HTTP_OK);
            } else {
                auth()->attempt($request->only('email', 'password'));
                return \response()->json(['success' => true], Response::HTTP_OK);
            }
        }
    }

    public function destroy()
    {
        auth()->logout();
        Session::flush();
        return redirect()->route('star.index');
    }
}