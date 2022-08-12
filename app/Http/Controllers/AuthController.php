<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(request $request) //: array|string
    {
        $guard = Auth::guard();

        $data = [
            'login' => $request->login,
            'password' => $request->password
        ];

        if ( ! $guard->attempt($data)) {
            return('Неправильно дурашка'); //throw new ApiResultException('User doesn\'t exist');
        }

        $user = $guard->user();

        $token = $user->createToken('token-auth')->plainTextToken;

        return [
            'token' => $token
        ];

    }
}
