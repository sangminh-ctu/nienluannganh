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


    public function __construct()
    {
        
        $this->tour = new Tours();
        $this->booking = new Booking();
        // $this->checkout = new Checkout();
    }

    public function index($id)
    {

        $title = 'Đặt Tour';
        $tour = $this->tour->getTourDetail($id);
        $transIdMomo = null; // Initialize the variable
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
        $paymentMethod = $req->input('payment_hidden');
        $tel = $req->input('tel');
        $totalPrice = $req->input('totalPrice');
        $tourId = $req->input('tourId');
        $userId = session()->get('userId');
        /**
         * Xử lý booking và checkout
         */
        $dataBooking = [
            'tourId'      => $tourId,
            'userId'       => $userId, // Đổi 'userId' thành 'useId' ở đây nè Sang
            'address'     => $address,
            'fullName'    => $fullName,
            'email'       => $email,
            'numAdults'   => $numAdults,
            'numChildren' => $numChildren,
            'phoneNumber' => $tel,
            'totalPrice'  => $totalPrice,
            'bookingDate' => now()->format('Y-m-d'), // Nhớ thêm ngày đặt
            'bookingStatus' => 'y'
        ];
        

        $bookingId = $this->booking->createBooking($dataBooking);
    }
}
