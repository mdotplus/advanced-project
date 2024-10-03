<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Area;
use App\Models\Category;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $selectOptions = [
            'areas' => Area::all(),
            'categories' => Category::all(),
        ];

        $shops = Shop::all();
        $reviewPoints = Review::getReviewPoints();
        $favoriteShopIds = Favorite::getFavoriteShopIds(Auth::id());

        return view('index', [
            'shops' => $shops,
            'reviewPoints' => $reviewPoints,
            'favoriteShopIds' => $favoriteShopIds,
            'selectOptions' => $selectOptions,
        ]);
    }

    public function thanks()
    {
        return view('auth/thanks');
    }

    public function detail($shopId, $redirectPath)
    {
        $shop = Shop::find($shopId);
        return view('detail', [
            'shop' => $shop,
            'redirectPath' => $redirectPath === 'home' ? '' : $redirectPath,
        ]);
    }

    public function reservation(ReservationRequest $request)
    {
        Reservation::create($request->all());
        return view('done');
    }

    public function reservationDelete(Request $request)
    {
        Reservation::find($request->reservation_id)->delete();
        return redirect('mypage');
    }

    public function reservationModify($reservationId, $redirectPath)
    {
        return view('reservation_modify', [
            'reservation' => Reservation::find($reservationId),
            'redirectPath' => $redirectPath === 'home' ? '' : $redirectPath,
        ]);
    }

    public function reservationUpdate(Request $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Reservation::find($request->reservation_id)->update($form);

        return redirect('mypage');
    }

    public function favorite($userId, $shopId, $redirectPath)
    {
        Favorite::create([
            'user_id' => $userId,
            'shop_id' => $shopId,
        ]);

        $redirectPath = $redirectPath === 'home' ? '' : $redirectPath;

        return redirect($redirectPath);
    }

    public function mypage()
    {
        $shops = Shop::all();
        $reservedShopsPresent = Reservation::getReservedShopsPresent(Auth::id());
        $reservedShopsPast = Reservation::getReservedShopsPast(Auth::id());
        $reviewIds = Review::getReviewIds(Auth::id());
        $reviewedReservationIds = Review::getReviewedReservationIds(Auth::id());
        $favoriteShopIds = Favorite::getFavoriteShopIds(Auth::id());

        return view('layouts/mypage', [
            'shops' => $shops,
            'reservedShopsPresent' => $reservedShopsPresent,
            'reservedShopsPast' => $reservedShopsPast,
            'reviewIds' => $reviewIds,
            'reviewedReservationIds' => $reviewedReservationIds,
            'favoriteShopIds' => $favoriteShopIds,
        ]);
    }

    public function review(Request $request)
    {
        $reservedShop = Reservation::find($request->reservation_id);
        $review = Review::find($request->review_id);

        return view('review', [
            'reservedShop' => $reservedShop,
            'review' => $review,
        ]);
    }

    public function reviewUpdate(Request $request)
    {
        if($request->review_id) {
            Review::find($request->review_id)->update($request->all());
        } else {
            Review::create($request->all());
        }

        return redirect('mypage');
    }
}
