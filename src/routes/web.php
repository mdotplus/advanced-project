<?php

use App\Http\Controllers\IndexController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

Route::get('/', [IndexController::class, 'index']);

Route::group(['middleware' => ['verified', 'auth']], function () {
    Route::get('/thanks', [IndexController::class, 'thanks']);
    Route::get('/detail/{shopId}/{redirectPath?}', [IndexController::class, 'detail']);
    Route::post('/done', [IndexController::class, 'reservation']);
    Route::post('/favorite/{userId}/{shopId}', [IndexController::class, 'favorite']);
    Route::get('/mypage', [IndexController::class, 'mypage']);
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/thanks');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
