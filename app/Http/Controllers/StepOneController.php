<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StepOneController extends Controller
{
    public function showForm()
    {
        return view('forms.step-1');
    }

    public function handle(Request $request)
    {
        // Validate data
        // Persist data ready for displaying step 2

        return redirect('step-2');
    }
}
