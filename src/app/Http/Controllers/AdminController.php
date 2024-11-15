<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRegisterRequest;
use App\Models\Area;
use App\Models\Authority;
use App\Models\Category;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function adminpage()
    {
        $users = User::paginate(8);
        $authorities = Authority::all();

        $selectOptions = [
            'areas' => Area::all(),
            'categories' => Category::all(),
        ];
        $shops = Shop::all();
        $validReservations = Reservation::getValidReservations();
        $reviewPoints = Review::getReviewPoints();

        return view('/layouts/adminpage', [
            'users' => $users,
            'authorities' => $authorities,
            'selectOptions' => $selectOptions,
            'shops' => $shops,
            'validReservations' => $validReservations,
            'reviewPoints' => $reviewPoints,
        ]);
    }

    public function userUpdate(Request $request)
    {
        User::find($request->user_id)->update($request->all());

        return redirect('adminpage');
    }

    public function userDelete(Request $request)
    {
        User::find($request->user_id)->delete();
        return redirect('adminpage');
    }

    public function shopCreate($userId)
    {
        $selectOptions = [
            'areas' => Area::all(),
            'categories' => Category::all(),
        ];

        return view('/adminpage/shop_register', [
            'userId' => $userId,
            'selectOptions' => $selectOptions,
        ]);
    }

    public function shopRegister(ShopRegisterRequest $request)
    {
        $form = $request->all();

        if ($request->file('image') !== null) {
            /* $filePath = basename($request->file('image')->store('public/img')); */
            $filePath = Storage::disk('s3')->putFile('rese-s3-mdp', $request->file('image'), 'public');
            /* $form['image_url'] = 'storage/img/' . $filePath; */
            $form['image_url'] = Storage::disk('s3')->url($filePath);
        }
        unset($form['_token']);

        Shop::create($form);

        return redirect('adminpage');
    }

    public function shopUpdate(Request $request)
    {
        Shop::find($request->shop_id)->update($request->all());
        return redirect('adminpage');
    }

    public function shopDelete(Request $request)
    {
        Shop::find($request->shop_id)->delete();
        return redirect('adminpage');
    }
}
