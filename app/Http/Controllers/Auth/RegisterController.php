<?php

namespace App\Http\Controllers\Auth;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Lang;

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
    protected $redirectTo = '/';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|regex:/(?=.*[A-Z])(?=.*[0-9])/|confirmed',
            ],
            [
                'name.required' => Lang::get('users.name') . " es requerido.",
                'name.max' => Lang::get('name.email') . " no debe contener más de 255 caracteres.",

                'last_name.required' => Lang::get('users.last_name') . " es requerido.",
                'last_name.max' => Lang::get('last_name.email') . " no debe contener más de 255 caracteres.",

                'email.unique' => Lang::get('users.email') . " ya está en uso.",
                'email.max' => Lang::get('users.email') . " no debe contener más de 255 caracteres.",

                'password.min' => Lang::get('users.password') . " debe tener al menos 6 caracteres y debe incluir al menos una letra mayúscula y un número.",
                'password.regex' => Lang::get('users.password') . " debe tener al menos 6 caracteres y debe incluir al menos una letra mayúscula y un número.",
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Model\User
     */
    protected function create(array $data)
    {
        return User::create([
            'last_name' => $data['last_name'],
            'name' => $data['name'],
            'username' => strtolower($data['email']),
            'email' => strtolower($data['email']),
            'password' => $data['password'],
        ]);
    }
}
