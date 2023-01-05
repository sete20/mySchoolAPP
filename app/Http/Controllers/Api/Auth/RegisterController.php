<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $request->merge(['user_type' => 'student']);
        $user = User::create($request->except(['image']));
        if ($request->image != null) {
            $user->addMedia($request->image)->toMediaCollection('personal_image');
        }
        auth()->loginUsingId($user->id);
        return  response()->json(['message' => 'success', 'data' => [
            'token' => auth()->user()->createToken('MyApp')->plainTextToken,
            'user_data' => new UserResource(auth()->user()->load(['subscription', 'units', 'provider']))
        ]], 200);
    }
}
