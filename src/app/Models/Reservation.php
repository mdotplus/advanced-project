<?php

namespace App\Models;

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
        $reservedShops = Reservation::where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'asc')
            ->get();

        return $reservedShops;
    }
}
