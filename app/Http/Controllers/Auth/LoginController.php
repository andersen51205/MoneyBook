<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        /**
         * middleware('guest')：已登入帳號導向首頁，未登入帳號繼續請求
         */
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login page.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        return view('Auth.Login');
    }

    /**
     * Handle a login request to the application.
     *
     * @return 
     */
    public function login(Request $request) {
        // 表單驗證
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        // 認證帳密
        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json([
                'message' => 'Email不存在或密碼錯誤',
            ], 400);
        }
        // 重新產生sessionID
        $request->session()->regenerate();
        // Redirect
        return response()->json([
            'message' => 'LOGIN_SUCCESS',
            'redirectTarget' => route('UserHome_View')
        ], 200);
    }

    /**
     * Handle a logout request to the application.
     *
     * @return 
     */
    public function logout(Request $request) {
        // 登出使用者
        Auth::logout();
        // 重新產生sessionID並刪除舊資料
        $request->session()->invalidate();
        // 重新產生CSRF Token
        $request->session()->regenerateToken();
        // Redirect
        return redirect()->route('Login_View');
    }
}
