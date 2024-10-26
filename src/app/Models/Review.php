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

    public function getReviews($shopId)
    {
        $reservations = Reservation::where('shop_id', $shopId)->get();

        $reviews = [];
        foreach ($reservations as $reservation) {
            $review = Review::where('reservation_id', $reservation->id)->first();

            if (isset($review)) {
                array_push($reviews, $review);
            }
        }

        return $reviews;
    }

    public function getReviewIds($userId)
    {
        $reservationIds = Reservation::getReservedShops($userId)
            ->select('id')
            ->get()
            ->toArray();

        $reviewIds = [];
        foreach ($reservationIds as $id) {
            $review = Review::where('reservation_id', $id)->first();

            if (isset($review)) {
                array_push($reviewIds, $review->id);
            }
        }

        return $reviewIds;
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

    public function getReviewPoints()
    {
        $reviewsGroupByShop = Review::with(['reservation'])
            ->get()
            ->groupBy(function ($item, $key) {
                return $item->reservation->shop_id;
            })->toArray();

        $reviewPoints = [];
        foreach ($reviewsGroupByShop as $shopId => $reviewContents) {
            $points = [];
            foreach ($reviewContents as $index => $value) {
                array_push($points, $value['five_point_scale']);
            }

            $average = array_sum($points) / count($points);
            $reviewPoints[$shopId] = [
                'count' => count($points),
                'average' => $average,
            ];
        }

        return $reviewPoints;
    }
}
