<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 已由後台route group進行auth驗證
        // $this->middleware('auth');
    }

    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('User.Home');
    }

    /**
     * Show the account management.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function account()
    {
        return view('User.Account');
    }
}
