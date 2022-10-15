<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application's registration page.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        return view('Auth.Register');
    }

    /**
     * Handle a registration request to the application.
     *
     * @return 
     */
    public function register(Request $request) {
        // 表單驗證
        $validated = $request->validate([
            'username' => 'required|string|max:20',
            'email' => 'required|string|email|max:255',// unique:users
            'password' => 'required|string|min:8|max:20|confirmed',
            'agreeTerms' => 'required',
        ]);
        // 檢查email是否已被註冊
        $email = User::where('email', $request['email'])
                     ->first();
        if($email) {
            return response()->json([
                'message' => '電子郵件信箱已被註冊',
            ], 400);
        }
        // 註冊
        $user = User::create([
            'name' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        // 註冊成功自動登入
        Auth::guard()->login($user);
        // Response
        return response()->json([
            'message' => '註冊成功',
            'redirectPage' => route('UserHome_View')
        ], 200);
    }
}
