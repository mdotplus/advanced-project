<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\StripeController;
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
    Route::controller(IndexController::class)->group(function () {
        Route::get('/thanks', 'thanks');
        Route::get('/detail/{shopId}/{redirectPath}', 'detail');
        Route::post('/reservation', 'reservation');
        Route::post('/reservation/delete', 'reservationDelete');
        Route::post('/reservation/modify/{reservationId}/{redirectPath}', 'reservationModify');
        Route::post('/reservation/update', 'reservationUpdate');
        Route::post('/favorite/{userId}/{shopId}/{redirectPath}', 'favorite');
    });

    Route::controller(MypageController::class)->group(function () {
        Route::get('/mypage', 'mypage');
        Route::post('/review', 'review');
        Route::post('/review/update', 'reviewUpdate');
    });

    Route::controller(AdminController::class)->prefix('adminpage')->group(function () {
        Route::get('', 'adminpage');
        Route::post('/user/update', 'userUpdate');
        Route::post('/user/delete', 'userDelete');
        Route::get('/shop/create/{userId}', 'shopCreate');
        Route::post('/shop/register', 'shopRegister');
        Route::post('/shop/update', 'shopUpdate');
        Route::post('/shop/delete', 'shopDelete');
    });

    Route::controller(NoticeController::class)->prefix('notice')->group(function () {
        Route::get('', 'notice');
        Route::post('/send', 'noticeSend');
    });

    Route::post('/create-checkout-session', [StripeController::class, 'createCheckoutSession']);
    Route::get('/success', [IndexController::class, 'index'])->name('success');
    Route::get('/cancel', [IndexController::class, 'index'])->name('cancel');
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
