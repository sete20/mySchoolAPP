<?php

// use App\Http\Controllers\Api\Auth\RegisterController;

use App\Http\Controllers\Api\EditProfileController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Requests\Api\CheckEmailResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

route::post('forget/password', [ResetPasswordController::class, 'sendMail']);
route::post('change/password', [ResetPasswordController::class, 'checkCode']);

Route::group(['prefix' => 'auth', 'namespace' => 'auth'], function () {
    route::post('register', RegisterController::class);
    route::post('login', LoginController::class);
    route::post('social/auth', SocialAuthController::class);
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('update/profile', EditProfileController::class);
});
