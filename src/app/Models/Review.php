<?php

namespace App\Models;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['reservation_id', 'five_point_scale', 'comment'];

    public function reservation()
    {
        return $this->belongsTo('App\Models\Reservation');
    }

    public function getReviewedReservationIds($userId)
    {
        $reservationIds = Reservation::getReservedShops($userId)
            ->select('id')
            ->get()
            ->toArray();

        $reviewedReservationIds = [];
        foreach ($reservationIds as $id) {
            $review = Review::where('reservation_id', $id)->first();

            if (isset($review)) {
                array_push($reviewedReservationIds, $review->reservation_id);
            }
        }

        return $reviewedReservationIds;
    }
}
