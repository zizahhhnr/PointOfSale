<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    protected function redirectTo() 
    {
        return RouteServiceProvider::home();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function login(Request $request)
     {
         $credentials = $request->validate([
             'email' => 'required|email',
             'password' => 'required|min:6',
         ]);
     
         if (Auth::attempt($credentials)) {
             $request->session()->regenerate();
     
             // Redirect berdasarkan role
             if (Auth::user()->role == 'admin') {
                 return redirect()->route('dashboard');
             } else {
                 return redirect()->route('kasir.dashboard');
             }
         }
     
         return back()->withErrors([
             'email' => 'Email atau password salah.',
         ]);
     }
     
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/'); // Redirect ke halaman setelah logout
    }
    
}

