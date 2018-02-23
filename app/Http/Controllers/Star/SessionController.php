<?php

namespace App\Http\Controllers\Star;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:255'
        ]);
        if (!auth()->attempt($request->only('email', 'password'), $request->has('remember'))) {
            return back()->withInput();
        }
        return redirect()->route('star.index');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect()->route('star.index');
    }
}