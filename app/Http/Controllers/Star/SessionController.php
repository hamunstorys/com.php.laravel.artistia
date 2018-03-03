<?php

namespace App\Http\Controllers\Star;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            $request->flashOnly(['password', 'email']);
            return \response()->json([
                'success' => false,
                'message' => '아이디가 없습니다.',
            ], 403);
        } else {
            if (!auth()->attempt($request->only('email', 'password'))) {
                $request->flashOnly(['password', 'email']);
                return \response()->json([
                    'success' => false,
                    'message' => '비밀번호가 틀렸습니다.',
                ], 403);
            }
        }

        auth()->attempt($request->only('email', 'password'));
        return \response()->json(['success' => true], 200);
    }

    public function destroy()
    {
        auth()->logout();
        Session::flush();
        return redirect()->route('star.index');
    }
}