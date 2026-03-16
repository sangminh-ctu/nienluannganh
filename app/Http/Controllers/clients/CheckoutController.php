<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index($id){

    $title = 'Đặt Tour';

    return view('clients.checkout',compact('title'));
    }
}
