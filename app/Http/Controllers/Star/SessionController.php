<?php

namespace App\Http\Controllers\Star;

use App\Http\Controllers\Controller;
use App\Models\Star\Star_User;
use Illuminate\Http\Request;
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
        $user = DB::table('star_users')->where('email', $request->email)->first();
        if ($user == null) {
            return 'id';
        } else {
            if (!auth()->attempt($request->only('email', 'password'))) {
                return 'password';
            }
        }
        return redirect()->route('star.index');
    }

    public function destroy()
    {
        auth()->logout();
        Session::flush();
        return redirect()->route('star.index');
    }
}