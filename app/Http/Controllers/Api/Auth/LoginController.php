<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $r)
    {
        if (auth()->attempt(['email' => $r->email, 'password' => $r->password])) return  response()->json(['message' => 'success', 'data' => [
            'token' => auth()->user()->createToken('MyApp')->plainTextToken,
            'user_data' => new UserResource(auth()->user()->load(['subscription', 'units', 'provider']))
        ]], 200);
        else return response()->json(['message' => 'undefined user please enter correct data or register new user'], 403);
    }
}
