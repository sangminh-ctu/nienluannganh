<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Tours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MyTourController extends Controller
{
    private $tours;

    public function __construct()
    {
        parent::__construct(); // Gọi constructor của Controller để khởi tạo $user
        $this->tours = new Tours();
    }

    // public function index()
    // {
    //     $title = 'Tours đã đặt';
    //     $userId = $this->getUserId();
        
    //     $myTours = $this->user->getMyTours($userId);
    //     $userId = $this->getUserId();
    //     if ($userId) {
    //         // Gọi API Python để lấy danh sách tour được gợi ý cho từng người dùng 
    //         try {
    //             $apiUrl = 'http://127.0.0.1:5555/api/user-recommendations';
    //             $response = Http::get($apiUrl, [
    //                 'user_id' => $userId
    //             ]);

    //             if ($response->successful()) {
    //                 $tourIds = $response->json('recommended_tours');
    //                 $tourIds = array_slice($tourIds, 0, 2);
    //             } else {
    //                 $tourIds = [];
    //             }
    //         } catch (\Exception $e) {
    //             // Xử lý lỗi khi gọi API
    //             $tourIds = [];
    //             \Log::error('Lỗi khi gọi API liên quan: ' . $e->getMessage());
    //         }


    //         $toursPopular = $this->tours->toursRecommendation($tourIds);
    //         // dd($toursPopular);
    //     }else {
    //         $toursPopular = $this->tours->toursPopular(6);
    //     }

    //     return view('clients.my-tours', compact('title', 'myTours','toursPopular'));
    // }

   public function index()
{
    $title = 'Tours đã đặt';
    $userId = $this->getUserId();
    
    // 1. Lấy danh sách tour của người dùng
    $myTours = $this->user->getMyTours($userId);

    // 2. LOGIC TỰ ĐỘNG CẬP NHẬT TRẠNG THÁI (Kịch bản: b -> y -> f)
    if ($myTours && count($myTours) > 0) {
        $now = \Carbon\Carbon::now();
        
        foreach ($myTours as $item) {
            // Lấy thời điểm kết thúc là cuối ngày của endDate (23:59:59)
            $endDateTime = \Carbon\Carbon::parse($item->endDate)->endOfDay();

            // TRƯỜNG HỢP 1: Tour ĐÃ KẾT THÚC (Thời gian hiện tại > Ngày kết thúc)
            if ($now->greaterThan($endDateTime)) {
                if ($item->bookingStatus != 'f' && $item->bookingStatus != 'c') {
                    \DB::table('tbl_booking')
                        ->where('bookingId', $item->bookingId)
                        ->update(['bookingStatus' => 'f']);
                    
                    $item->bookingStatus = 'f';
                }
            } 
            // TRƯỜNG HỢP 2: Tour CHƯA KẾT THÚC (Vẫn còn hạn đi)
            else {
              
                //  đưa  về 'b' (Đợi xác nhận) hoặc 'y' 
                if ($item->bookingStatus == 'f') {
                    \DB::table('tbl_booking')
                        ->where('bookingId', $item->bookingId)
                        ->update(['bookingStatus' => 'b']); // Đưa về 'b' để Admin duyệt lại
                    
                    $item->bookingStatus = 'b';
                }
            }
        }
    }

    // 3. Phần API Python (Giữ nguyên của Sang)
    if ($userId) {
        try {
            $apiUrl = 'http://127.0.0.1:5555/api/user-recommendations';
            $response = \Illuminate\Support\Facades\Http::get($apiUrl, ['user_id' => $userId]);

            if ($response->successful()) {
                $tourIds = array_slice($response->json('recommended_tours'), 0, 2);
            } else {
                $tourIds = [];
            }
        } catch (\Exception $e) {
            $tourIds = [];
            \Log::error('Lỗi API gợi ý: ' . $e->getMessage());
        }
        $toursPopular = $this->tours->toursRecommendation($tourIds);
    } else {
        $toursPopular = $this->tours->toursPopular(6);
    }

    return view('clients.my-tours', compact('title', 'myTours', 'toursPopular'));
}
}
