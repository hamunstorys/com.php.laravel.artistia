<?php

namespace App\Http\Controllers\Star;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('flush_query');
        $this->middleware('search_requirement');
    }

    public function index()
    {
        if (auth()->check()) {
            return view('star.index');
        }
        return redirect(route('star.session.create'));
    }
}