<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Area;
use App\Models\Category;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Reservation;
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
        $favoriteShopIds = Favorite::getFavoriteShopIds(Auth::id());

        return view('index', [
            'shops' => $shops,
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
        $favoriteShopIds = Favorite::getFavoriteShopIds(Auth::id());

        return view('layouts/mypage', [
            'shops' => $shops,
            'reservedShopsPresent' => $reservedShopsPresent,
            'reservedShopsPast' => $reservedShopsPast,
            'favoriteShopIds' => $favoriteShopIds,
        ]);
    }
}
