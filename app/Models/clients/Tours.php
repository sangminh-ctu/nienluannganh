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
    public function getAllTour()
    {
        $allTour = DB::table($this->table)->get();
        foreach ($allTour as $tour) {
            // Lấy danh sách hình ảnh thuộc về tour
            $tour->images = DB::table('tbl_images')
                ->where('tourId', $tour->tourId)
                ->pluck('imgURL');
        }
        return $allTour;
    }

    // Lấy khu vực đến: Bắc-Trung-Nam
    public function getDomain()
    {
        return DB::table($this->table)
            ->select('domain', DB::raw('COUNT(*) as count'))
            ->whereIn('domain', ['b', 't', 'n'])
            ->groupBy('domain')
            ->get();
    }

    public function filterTours($filters = [], $sorting = null, $perPage = null)
    {

        DB::enableQueryLog();
        $getTours = DB::table($this->table);

    //áp dụng bộ lọc
        if (!empty($filters)) {
        $getTours = $getTours->where($filters);
       
    }

   
        if (!empty($sorting) && isset($sorting[0]) && isset($sorting[1])) {
            $getTours = $getTours->orderBy($sorting[0], $sorting[1]);
        }

     $tours = $getTours->get();

        foreach ($tours as $tour) {
        $tour->images = DB::table('tbl_images')
            ->where('tourId', $tour->tourId)
            ->pluck('imgURL');
    }



    
        
        $queryLog = DB::getQueryLog();
        


        return $tours;
}


    public function updateTours($tourId,$data){
        $update = DB::table($this->table)
            ->where('tourId', $tourId)
            ->update($data);

        return $update;
    }

    public function toursRecommendation($tourIds)
{
    // 1. Kiểm tra nếu mảng ID rỗng thì trả về mảng trống để tránh lỗi SQL
    if (empty($tourIds)) {
        return collect(); 
    }

    // 2. Query lấy thông tin từ bảng tbl_tour theo danh sách ID gợi ý
    // Sử dụng whereIn để tìm tất cả tour có ID nằm trong mảng $tourIds
    $tours = DB::table('tbl_tour')
        ->whereIn('tourId', $tourIds)
        ->get();

    // 3. Xử lý lấy ảnh cho từng tour gợi ý (theo bảng tbl_images của Sang)
    foreach ($tours as $tour) {
        $firstImage = DB::table('tbl_images')
            ->where('tourId', $tour->tourId)
            ->first();
        // Gán ảnh vào thuộc tính images để file Blade sử dụng được
        $tour->images = $firstImage ? [$firstImage->imgURL] : ['default.jpg'];
    }

    return $tours;
}


      //Lấy detail tour đã đặt
    public function tourBooked($bookingId, $checkoutId)
    {
        $booked = DB::table($this->table)
            ->join('tbl_booking', 'tbl_tour.tourId', '=', 'tbl_booking.tourId')
            ->join('tbl_checkout', 'tbl_booking.bookingId', '=', 'tbl_checkout.bookingId')
            ->where('tbl_booking.bookingId', '=', $bookingId)
            ->where('tbl_checkout.checkoutId', '=', $checkoutId)
            ->first();

        return $booked;
    }

    
    //Tạo đánh giá về tours
    public function createReviews($data)
    {
        return DB::table('tbl_reviews')->insert($data);
    }

    //Lấy danh sách nội dung reviews 
    public function getReviews($id)
    {
        $getReviews = DB::table('tbl_reviews')
            ->join('tbl_users', 'tbl_users.userId', '=', 'tbl_reviews.userId')
            ->where('tourId', $id)
            ->orderBy('tbl_reviews.timestamp', 'desc')
            ->take(3)
            ->get();

        return $getReviews;
    }

    //Lấy số lượng đánh giá và số sao trung bình của tour
    public function reviewStats($id)
    {
        $reviewStats = DB::table('tbl_reviews')
            ->where('tourId', $id)
            ->selectRaw('AVG(rating) as averageRating, COUNT(*) as reviewCount')
            ->first();

        return $reviewStats;
    }

    //Kiểm tra xem người dùng đã đánh giá tour này hay chưa?

    public function checkReviewExist($tourId, $userId)
    {
        return DB::table('tbl_reviews')
            ->where('tourId', $tourId)
            ->where('userId', $userId)
            ->exists(); // Trả về true nếu bản ghi tồn tại, false nếu không tồn tại
    }

    // //Search tours
    // public function searchTours($data)
    // {
    //     $tours = DB::table($this->table);


    //     // Thêm điều kiện cho destination với LIKE
    //     if (!empty($data['destination'])) {
    //         $tours->where('destination', 'LIKE', '%' . $data['destination'] . '%');
    //     }

    //     // Thêm điều kiện cho startDate và endDate nếu cần so sánh
    //     if (!empty($data['startDate'])) {
    //         $tours->whereDate('startDate', '>=', $data['startDate']);
    //     }
    //     if (!empty($data['endDate'])) {
    //         $tours->whereDate('endDate', '<=', $data['endDate']);
    //     }

    //     // Thêm điều kiện tìm kiếm với LIKE cho title, time và description
    //     if (!empty($data['keyword'])) {
    //         $tours->where(function ($query) use ($data) {
    //             $query->where('title', 'LIKE', '%' . $data['keyword'] . '%')
    //                 ->orWhere('description', 'LIKE', '%' . $data['keyword'] . '%')
    //                 ->orWhere('time', 'LIKE', '%' . $data['keyword'] . '%')
    //                 ->orWhere('destination', 'LIKE', '%' . $data['keyword'] . '%');
    //         });
    //     }

    //     $tours = $tours->where('availability', 1);
    //     $tours = $tours->limit(12)->get();

    //     foreach ($tours as $tour) {
    //         // Lấy danh sách hình ảnh thuộc về tour
    //         $tour->images = DB::table('tbl_images')
    //             ->where('tourId', $tour->tourId)
    //             ->pluck('imageUrl');
    //         // Lấy số lượng đánh giá và số sao trung bình của tour
    //         $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
    //     }
    //     return $tours;
    // }

    // //Get tours recommendation
    // public function toursRecommendation($ids)
    // {

    //     if (empty($ids)) {
    //         // Return an empty collection to avoid executing the query with an empty `FIELD` clause
    //         return collect();
    //     }

    //     $toursRecom = DB::table($this->table)
    //         ->where('availability', '1')
    //         ->whereIn('tourId', $ids)
    //         ->orderByRaw("FIELD(tourId, " . implode(',', array_map('intval', $ids)) . ")") // Chuyển tất cả các giá trị sang kiểu int và giữ thứ tự
    //         ->get();
    //     foreach ($toursRecom as $tour) {
    //         // Lấy danh sách hình ảnh thuộc về tour
    //         $tour->images = DB::table('tbl_images')
    //             ->where('tourId', $tour->tourId)
    //             ->pluck('imageUrl');
    //         // Lấy số lượng đánh giá và số sao trung bình của tour
    //         $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
    //     }

    //     return $toursRecom;
    // }

    // //Get tour có số lượng booking và hoàn thành nhiều nhất để gợi ý
    // public function toursPopular($quantity)
    // {
    //     $toursPopular = DB::table('tbl_booking')
    //         ->select(
    //             'tbl_tours.tourId',
    //             'tbl_tours.title',
    //             'tbl_tours.description',
    //             'tbl_tours.priceAdult',
    //             'tbl_tours.priceChild',
    //             'tbl_tours.time',
    //             'tbl_tours.destination',
    //             'tbl_tours.quantity',
    //             DB::raw('COUNT(tbl_booking.tourId) as totalBookings')
    //         )
    //         ->join('tbl_tours', 'tbl_booking.tourId', '=', 'tbl_tours.tourId')
    //         ->where('tbl_booking.bookingStatus', 'f') // Chỉ lấy các booking đã hoàn thành
    //         ->groupBy(
    //             'tbl_tours.tourId',
    //             'tbl_tours.title',
    //             'tbl_tours.description',
    //             'tbl_tours.priceAdult',
    //             'tbl_tours.priceChild',
    //             'tbl_tours.time',
    //             'tbl_tours.destination',
    //             'tbl_tours.quantity'
    //         )
    //         ->orderBy('totalBookings', 'DESC')
    //         ->take($quantity)
    //         ->get();


    //     foreach ($toursPopular as $tour) {
    //         // Lấy danh sách hình ảnh thuộc về tour
    //         $tour->images = DB::table('tbl_images')
    //             ->where('tourId', $tour->tourId)
    //             ->pluck('imageUrl');
    //         // Lấy số lượng đánh giá và số sao trung bình của tour
    //         $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
    //     }
    //     return $toursPopular;
    // }

    // //Get id search tours
    // public function toursSearch($ids)
    // {

    //     if (empty($ids)) {
    //         // Return an empty collection to avoid executing the query with an empty `FIELD` clause
    //         return collect();
    //     }

    //     $tourSearch = DB::table($this->table)
    //         ->where('availability', '1')
    //         ->whereIn('tourId', $ids)
    //         ->orderByRaw("FIELD(tourId, " . implode(',', array_map('intval', $ids)) . ")") // Chuyển tất cả các giá trị sang kiểu int và giữ thứ tự
    //         ->get();
    //     foreach ($tourSearch as $tour) {
    //         // Lấy danh sách hình ảnh thuộc về tour
    //         $tour->images = DB::table('tbl_images')
    //             ->where('tourId', $tour->tourId)
    //             ->pluck('imageUrl');
    //         // Lấy số lượng đánh giá và số sao trung bình của tour
    //         $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
    //     }

    //     return $tourSearch;
    // }
}