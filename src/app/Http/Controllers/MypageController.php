<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function mypage()
    {
        $shops = Shop::all();
        $reservedShopsPresent = Reservation::getReservedShopsPresent(Auth::id());
        $reservedShopsPast = Reservation::getReservedShopsPast(Auth::id());
        $reviewIds = Review::getReviewIds(Auth::id());
        $reviewedReservationIds = Review::getReviewedReservationIds(Auth::id());
        $reviewPoints = Review::getReviewPoints();
        $favoriteShopIds = Favorite::getFavoriteShopIds(Auth::id());

        return view('layouts/mypage', [
            'shops' => $shops,
            'reservedShopsPresent' => $reservedShopsPresent,
            'reservedShopsPast' => $reservedShopsPast,
            'reviewIds' => $reviewIds,
            'reviewedReservationIds' => $reviewedReservationIds,
            'reviewPoints' => $reviewPoints,
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

    public function reviewUpdate(ReviewRequest $request)
    {
        if($request->review_id) {
            Review::find($request->review_id)->update($request->all());
        } else {
            Review::create($request->all());
        }

        return redirect('mypage');
    }
}
