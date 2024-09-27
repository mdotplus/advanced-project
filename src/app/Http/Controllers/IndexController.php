<?php

namespace App\Http\Controllers;

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
        $favoriteShops = Favorite::getFavoriteShops(Auth::id());

        return view('index', [
            'shops' => $shops,
            'favoriteShops' => $favoriteShops,
            'selectOptions' => $selectOptions,
        ]);
    }

    public function thanks()
    {
        return view('auth/thanks');
    }

    public function detail($shopId)
    {
        $shop = Shop::find($shopId);
        return view('detail', ['shop' => $shop]);
    }

    public function reservation(Request $request)
    {
        Reservation::create($request->all());
        return view('done');
    }

    public function favorite($userId, $shopId)
    {
        Favorite::create([
            'user_id' => $userId,
            'shop_id' => $shopId,
        ]);

        return redirect('/');
    }
}
