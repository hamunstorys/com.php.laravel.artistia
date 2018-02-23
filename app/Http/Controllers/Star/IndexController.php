<?php

namespace App\Http\Controllers\Star;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        if (auth()->check()) {
            return view('star.index');
        }
        return redirect(route('star.session.create'));
    }
}