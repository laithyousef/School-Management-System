<?php

namespace App\Http\Controllers\Auth;

use App\Http\Traits\AuthTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request; 

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
    
    use AuthTrait;

    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    
    public function login_form($type)
    {
        return view('auth.login', compact('type'));
    }

    public function login(Request $request)
    { 
        if(Auth::guard($this->chekGuard($request))->attempt([ 'email' => $request->email, 'password' => $request->password ])) {
            return $this->redirect($request);
        }
        else {
            return redirect()->back()->with('message', trans('messages.wrong_credentials'));
        }
    }

    public function logout(Request $request, $type)
    {
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }

}
