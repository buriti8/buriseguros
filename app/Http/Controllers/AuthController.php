<?php

namespace App\Http\Controllers;

use App\ApiCode;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login()
    {
        $credentials = request()->validate(['username' => 'required', 'password' => 'required|min:6']);

        if (!$token = auth('api')->attempt($credentials)) {
            return $this->respondUnAuthorizedRequest(ApiCode::INVALID_CREDENTIALS);
        }

        return $this->respondWithToken($token);
    }

    private function respondWithToken($token)
    {
        return $this->respond([
            'token' => $token,
            'access_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ], "Login exitoso");
    }


    public function logout()
    {
        auth()->logout();
        return $this->respondWithMessage('El usuario ha cerrado cesión.');
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function me()
    {
        return $this->respond(auth()->user());
    }
}
