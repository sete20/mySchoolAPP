<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SocialAuthRequest;
use App\Http\Resources\Api\UserResource;
use App\Models\SocialProvider;
use App\Models\User;
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    public function __invoke(SocialAuthRequest $r)
    {
        if (SocialProvider::where('provider_id', $r->provider_id)->where('provider', $r->provider_name)->first())
            return $this->login($r);
        else return $this->register($r);
    }
    private function login($r)
    {
        $user = User::where('email', $r->email)->first();
        auth()->loginUsingId($user->id);
        return  response()->json(['message' => 'success', 'data' => [
            'token' => auth()->user()->createToken('MyApp')->plainTextToken,
            'user_data' => new UserResource(auth()->user()->load(['subscription', 'units', 'provider']))
        ]], 200);
    }
    private function register($r)
    {
        $r->merge(['user_type' => 'student']);
        $user = User::create($r->except(['_token', 'provider_id', 'provider_name']));
        SocialProvider::create(['user_id' => $user->id, 'provider_id' => $r->provider_id, 'provider' => $r->provider_name]);
        if ($r->image != null) {
            $user->addMedia($r->image)->toMediaCollection('personal_image');
        }
        auth()->loginUsingId($user->id);
        return  response()->json(['message' => 'success', 'data' => [
            'token' => auth()->user()->createToken('MyApp')->plainTextToken,
            'user_data' => new UserResource(auth()->user()->load(['subscription', 'units', 'provider']))
        ]], 200);
    }
}
