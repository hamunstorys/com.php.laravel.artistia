<?php

namespace App\Http\Controllers\Star;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('star.index');
    }
}
