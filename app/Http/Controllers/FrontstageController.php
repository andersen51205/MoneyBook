<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontstageController extends Controller
{
    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Home');
    }
}
