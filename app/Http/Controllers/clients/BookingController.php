<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Booking;
use App\Models\clients\Checkout;
use App\Models\clients\Tours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookingController extends Controller
{

    private $tour;
    private $booking;
    private $checkout;


    public function __construct()
    {
        parent::__construct();
        $this->tour = new Tours();
        $this->booking = new Booking();
        $this->checkout = new Checkout();
    }

    public function index($id)
    {

        $title = 'Đặt Tour';
        $tour = $this->tour->getTourDetail($id);

        return view('clients.booking', compact('title', 'tour'));
    }

    public function createBooking(Request $req)
    {
        // dd($req);
        $address = $req->input('address');
        $email = $req->input('email');
        $fullName = $req->input('fullName');
        $numAdults = $req->input('numAdults');
        $numChildren = $req->input('numChildren');
        $paymentMethod = $req->input('payment');
        $tel = $req->input('tel');
        $totalPrice = $req->input('totalPrice');
        $tourId = $req->input('tourId');
        $userId = session()->get('userId');
        /**
         * Xử lý booking và checkout
         */
        $dataBooking = [
            'tourId'      => $tourId,
            'userId'       => $userId,
            'address'     => $address,
            'fullName'    => $fullName,
            'email'       => $email,
            'numAdults'   => $numAdults,
            'numChildren' => $numChildren,
            'phoneNumber' => $tel,
            'totalPrice'  => $totalPrice,
            // 'bookingDate' => now()->format('Y-m-d'), // Nhớ thêm ngày đặt
            // 'bookingStatus' => 'y'
        ];
        // dd($dataBooking);

        $bookingId = $this->booking->createBooking($dataBooking);

        $dataCheckout = [
            'bookingId' => $bookingId,
            'paymentMethod' => $paymentMethod,
            'amount' => $totalPrice,
            'paymentStatus' => 'n',


        ];

        $checkout = $this->checkout->createCheckout($dataCheckout);

        if (empty($bookingId) && !$checkout) {

            // quay lại trang trước và gửi kèm tin nhắn lỗi
            return redirect()->back()->with('error', 'Có vấn đề khi đặt tours!');
        }


        /**
         * Update quantity cho tour đó trừ số lượng
         */
        $tour = $this->tour->getTourDetail($tourId);

        $dataUpdate = [
            'quantity' => $tour->quantity - ($numAdults + $numChildren),
        ];

        $updateQuantity = $this->tour->updateTours($tourId, $dataUpdate);

        /******************************************************************************************** */


        return redirect()->route('tours')
            ->with('msg', 'Đặt tour thành công');
    }


     //Kiểm tra người dùng đã đặt và hoàn thành tour hay chưa để đánh giá
    public function checkBooking(Request $req){
        $tourId = $req->tourId;
        $userId = $this->getUserId();
        $check = $this->booking->checkBooking($tourId,$userId);
        if (!$check) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true]);
    }
}
