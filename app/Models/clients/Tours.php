<?php

namespace App\Models\clients;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tours extends Model
{
    protected $table = 'tbl_tour';

   //Lấy chi tiết tour
    public function getTourDetail($id)
    {
        $getTourDetail = DB::table($this->table)
            ->where('tourId', $id)
            ->first();

        if ($getTourDetail) {
            // Lấy danh sách hình ảnh thuộc về tour
            $getTourDetail->images = DB::table('tbl_images')
                ->where('tourId', $getTourDetail->tourId)
                ->limit(5)
                ->pluck('imgURL');

            // Lấy danh sách timeline thuộc về tour
            $getTourDetail->timeline = DB::table('tbl_timeline')
                ->where('tourId', $getTourDetail->tourId)
                ->get();
        }


        return $getTourDetail;
    }


    //Lấy tất cả tour
    public function getAllTour(){
        $allTour = DB::table($this->table)->get();
          foreach ($allTour as $tour) {
            // Lấy danh sách hình ảnh thuộc về tour
          $tour->images = DB::table('tbl_images')
                ->where('tourId', $tour->tourId)
                ->pluck('imgURL');

           
    }
        return $allTour;
    }
}
