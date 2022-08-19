<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use ThrottlesLogins;


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    protected function getLogin()
    {
        return view("login");
    }

    public function postLogin(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);


        $credentials = $request->only('username', 'password', 'email');

        if ($this->auth->attempt($credentials, $request->has('remember'))) {

            return view("home");
        }

        return view()->with("msjerror", "credenciales incorrectas");
    }

    protected function getLogout()
    {
        $this->auth->logout();

        Session::flush();

        return back();
    }
}
