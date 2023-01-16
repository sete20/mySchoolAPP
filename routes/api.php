<?php

// use App\Http\Controllers\Api\Auth\RegisterController;

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\EditProfileController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\UserPackagesController;
use App\Http\Controllers\Api\UserUnitsController;
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
route::post('package', PackageController::class);
route::post('show/package/{subscription}', ShowPackageController::class);
route::post('show/unit/{unit}', UnitController::class);
route::post('show/subUnit/{subUnit}', SubUnitController::class);
Route::group(['middleware' => 'auth:sanctum'], function () {
    route::post('show/user/package', UserPackagesController::class);
    route::post('show/user/units', UserUnitsController::class);
    route::post('show/lesson/{lesson}', LessonController::class);
    Route::post('update/profile', EditProfileController::class);
    route::post('comment/{comment}', [CommentController::class, 'update']);
    route::delete('comment/{comment}', [CommentController::class, 'destroy']);
    route::post('comment', [CommentController::class, 'store']);
});
