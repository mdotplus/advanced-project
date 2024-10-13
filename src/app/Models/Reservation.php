<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes;

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
        return Reservation::where('user_id', $userId);
    }

    public function getReservedShopsPast($userId)
    {
        $reservedShops = Reservation::getReservedShops($userId);
        $reservedShopsPast = $reservedShops
            ->where('date', '<', Carbon::now()->format('Y-m-d'))
            ->orderBy('date', 'desc')
            ->orderBy('time', 'asc')
            ->get();

        return $reservedShopsPast;
    }

    public function getReservedShopsPresent($userId)
    {
        $reservedShops = Reservation::getReservedShops($userId);
        $reservedShopsPresent = $reservedShops
            ->where('date', '>=', Carbon::now()->format('Y-m-d'))
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        return $reservedShopsPresent;
    }

    public function getValidReservations()
    {
        $reservationsOnAndAfterToday = Reservation::where('date', '>=', Carbon::now()->format('Y-m-d'))
            ->orderBy('shop_id', 'asc')
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy('shop_id')
            ->toArray();

        $validReservations = [];
        foreach($reservationsOnAndAfterToday as $shopId => $reservations) {
            $all = [];
            $today = [];
            $afterToday = [];

            foreach($reservations as $reservation) {
                array_push($all, $reservation);

                if ($reservation['date'] === Carbon::now()->format('Y-m-d')) {
                    array_push($today, $reservation);
                } else {
                    array_push($afterToday, $reservation);
                }
            }

            $validReservations[$shopId] = [
                'all' => $all,
                'today' => $today,
                'afterToday' => $afterToday,
            ];
        }

        return $validReservations;
    }
}
