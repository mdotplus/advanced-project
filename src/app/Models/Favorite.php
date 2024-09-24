<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'shop_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }

    public function isFavorite($userId, $shopId)
    {
        $clickedCount = Favorite::where('user_id', $userId)
            ->where('shop_id', $shopId)
            ->count();

        return !($clickedCount % 2 === 0);
    }

    public function getFavoriteShops($userId)
    {
        $clickedShops = Favorite::where('user_id', $userId)
            ->get()
            ->groupBy('shop_id')
            ->toArray();

        $favoriteShops = [];
        foreach ($clickedShops as $shopId => $timestamps) {
            $clickedCount = collect($timestamps)->count();

            if ($clickedCount % 2 === 1) {
                array_push($favoriteShops, $shopId);
            }
        }

        return $favoriteShops;
    }
}
