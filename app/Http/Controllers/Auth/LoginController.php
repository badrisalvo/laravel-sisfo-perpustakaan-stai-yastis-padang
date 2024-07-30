<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        $this->middleware('guest')->except('logout');
    }
    protected function attemptLogin(Request $request)
{
    // Memeriksa apakah pengguna telah mencoba login
    if ($this->guard()->attempt($request->only('email', 'password'))) {
        // Memeriksa apakah pengguna adalah admin
        if ($this->guard()->user()->isAdmin == 1) {
            return true; // Izinkan login untuk pengguna admin
        }
    }
    return false; // Blokir login untuk pengguna non-admin atau kredensial yang tidak valid
}
}
