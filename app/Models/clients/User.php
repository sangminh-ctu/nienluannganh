<?php

namespace App\Models\clients;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'tbl_users';

    public function getUserID($username){
        return DB::table($this->table)
        ->select('userId')
        ->where('username',$username)->value('userId');
    }

    public function getUser($id){
        $user = DB::table($this->table)
        ->where('userId',$id)->first();
        return $user;
    }

     public function updateUser($id, $data)
    {
        $update = DB::table($this->table)
            ->where('userid', $id)
            ->update($data);

        return $update;
    }

     public function getMyTours($id)
    {
        $myTours =  DB::table('tbl_booking')
        ->join('tbl_tour', 'tbl_booking.tourId', '=', 'tbl_tour.tourId')
        ->join('tbl_checkout', 'tbl_booking.bookingId', '=', 'tbl_checkout.bookingId')
        ->where('tbl_booking.userId', $id)
        ->orderByDesc('tbl_booking.bookingDate')
        ->take(5) //Lấy ra bao nhiêu tour
        ->get();

        foreach ($myTours as $tour) {
            // Lấy rating từ tbl_reviews cho mỗi tour
            $tour->rating = DB::table('tbl_reviews')
                ->where('tourId', $tour->tourId)
                ->where('userId', $id)
                ->value('rating'); // Dùng value() để lấy giá trị rating
        }
        foreach ($myTours as $tour) {
            // Lấy danh sách hình ảnh thuộc về tour
            $tour->images = DB::table('tbl_images')
                ->where('tourId', $tour->tourId)
                ->pluck('imgUrl');
        }

        return $myTours;
    }

}

