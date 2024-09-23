<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        return view('index', ['shops' => $shops]);
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
}
