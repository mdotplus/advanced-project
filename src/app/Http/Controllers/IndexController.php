<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        $favoriteShops = Favorite::getFavoriteShops(Auth::id());

        return view('index', [
            'shops' => $shops,
            'favoriteShops' => $favoriteShops,
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

    public function favorite($userId, $shopId)
    {
        Favorite::create([
            'user_id' => $userId,
            'shop_id' => $shopId,
        ]);

        return redirect('/');
    }
}
