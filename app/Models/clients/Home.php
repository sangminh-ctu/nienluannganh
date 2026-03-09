<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home extends Model
{
    use HasFactory;

    protected $table = 'tbl_tour';

    public function getHomeTours()
    {
        // Lấy thông tin tour
        $tours = DB::table($this->table)
            // ->where('availability', 1)
            // ->take(8)
            ->get();

        foreach ($tours as $tour) {
            // Lấy danh sách hình ảnh thuộc về tour
          $tour->images = DB::table('tbl_images')
                ->where('tourId', $tour->tourId)
                ->pluck('imgURL');

            // // lấy danh sách timeLine thuộc về tour
            // $tour->timeLine = DB::table('tbl_timeline')
            //     ->where('tourId', $tour->tourId)
            //     ->pluck('title');
    }

        return $tours;
    }   
}
