<?php

use App\Http\Controllers\AdminController;
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
    Route::get('/detail/{shopId}/{redirectPath}', [IndexController::class, 'detail']);
    Route::post('/reservation', [IndexController::class, 'reservation']);
    Route::post('/reservation/delete', [IndexController::class, 'reservationDelete']);
    Route::post('/reservation/modify/{reservationId}/{redirectPath}', [IndexController::class, 'reservationModify']);
    Route::post('/reservation/update', [IndexController::class, 'reservationUpdate']);
    Route::post('/favorite/{userId}/{shopId}/{redirectPath}', [IndexController::class, 'favorite']);
    Route::get('/mypage', [IndexController::class, 'mypage']);
    Route::post('/review', [IndexController::class, 'review']);
    Route::post('/review/update', [IndexController::class, 'reviewUpdate']);

    Route::get('/adminpage', [AdminController::class, 'adminpage']);
    Route::post('/adminpage/user/update', [AdminController::class, 'userUpdate']);
    Route::post('/adminpage/user/delete', [AdminController::class, 'userDelete']);
    Route::get('/shop/create/{userId}', [AdminController::class, 'shopCreate']);
    Route::post('/shop/register', [AdminController::class, 'shopRegister']);
});

Route::get('/email/verify', function () {
    return view('auth.verify_email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/thanks');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
