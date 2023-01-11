<?php

use App\Http\Controllers\Web\AssistantController;
use App\Http\Controllers\Web\LessonController;
use App\Http\Controllers\Web\StudentController;
use App\Http\Controllers\Web\SubscriptionController;
use App\Http\Controllers\Web\SubUnitController;
use App\Http\Controllers\Web\UnitController;
// use App\Http\Controllers\SocialMediaPlatformController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});
// route::get('/test', function () {
//     dd(Session::get('locale'));
// })->middleware('assistant');
Auth::routes();
route::group(['namespace' => 'App\Http\Controllers\Web', 'middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\Web\HomeController::class, 'index'])->middleware('teacher', 'assistant')->name('home');
    Route::get('/change/{locale}', App\Http\Controllers\Web\LangController::class)->middleware('teacher', 'assistant')->name('change.lang');

    route::resource('assistant', AssistantController::class)->middleware('teacher')->parameters(['assistant' => 'user']);
    route::post('change/assistant/status/{user}', 'AssistantController@changeUserStatus')->name('assistant.status');

    route::resource('student', StudentController::class)->middleware('teacher')->parameters(['student' => 'user']);
    route::post('change/student/status/{user}', 'StudentController@changeUserStatus')->name('student.status')->middleware('teacher');

    route::resource('lesson', LessonController::class)->middleware('teacher', 'assistant');
    route::post('change/lesson/status/{lesson}', 'LessonController@changeLessonStatus')->name('lesson.status')->middleware('teacher');

    route::resource('subUnit', SubUnitController::class)->middleware('teacher');
    route::post('change/sub/unit/status/{subUnit}', 'SubUnitController@changeSubUnitStatus')->name('subUnit.status')->middleware('teacher');

    route::resource('unit', UnitController::class)->middleware('teacher');
    route::post('change/unit/status/{unit}', 'UnitController@changeUnitStatus')->name('unit.status')->middleware('teacher');

    route::resource('socialmedia', SocialMediaPlatformController::class)->parameters(['medium' => 'socialmedia'])->middleware('teacher');
    route::post('change/socialmedia/status/{socialmedia}', 'SocialMediaPlatformController@changeSocialmediaStatus')->name('socialmedia.status')->middleware('teacher');

    route::resource('subscription', SubscriptionController::class)->middleware('teacher');
    route::post('change/subscription/status/{subscription}', 'SubscriptionController@changesSubscriptionStatus')->name('subscription.status')->middleware('teacher');
});
