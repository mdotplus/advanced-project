<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'shop_id', 'date', 'time', 'number', 'paid_online_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }

    public function getReservedShops($userId)
    {
        return Reservation::where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'asc')
            ->get();
    }

    public function getReservedShopsPast($userId)
    {
        $reservedShops = Reservation::getReservedShops($userId);
        $reservedShopsPast = $reservedShops->where('date', '<', Carbon::now()->format('Y-m-d'));

        return $reservedShopsPast;
    }

    public function getReservedShopsPresent($userId)
    {
        $reservedShops = Reservation::getReservedShops($userId);
        $reservedShopsPresent = $reservedShops->where('date', '>=', Carbon::now()->format('Y-m-d'));

        return $reservedShopsPresent;
    }
}
