<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CheckEmailResetPasswordRequest;
use App\Http\Resources\Api\UserResource;
use App\Mail\Api\ResetPasswordMail;
use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Api\CheckCodeResetPasswordRequest;

class ResetPasswordController extends Controller
{
    public function sendMail(CheckEmailResetPasswordRequest $r)
    {
        $user = User::where('email', $r->email)->first();
        if ($user->reset_code) $user->reset_code()->delete();
        $code = Str::random(7);
        $user->reset_code()->create([
            'code' => $code,
            'expired_at' => now()->addHours(2)
        ]);
        Mail::to($r->email)->send(new ResetPasswordMail($code));
        return response()->json(['message code sent successfully please check your mail box'], 200);
    }
    public function checkCode(CheckCodeResetPasswordRequest $r)
    {
        $resetPassword = ResetPassword::firstWhere('code', $r->code);
        auth()->loginUsingId($resetPassword->user->id);
        $resetPassword->delete();
        return  response()->json(['message' => 'success please redirect to edit profile page', 'data' => [
            'token' => auth()->user()->createToken('MyApp')->plainTextToken,
            'user_data' => new UserResource(auth()->user()->load(['subscription', 'units', 'provider']))
        ]], 200);
    }
}
