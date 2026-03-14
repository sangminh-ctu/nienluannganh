<?php

namespace App\Http\Controllers\clients;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\User;
use Symfony\Component\Mime\Email;

class UserprofileController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function index(){
        $username = session()->get('username');
        $title = 'Thông tin cá nhân';
        $userId = $this->user->getUserId($username);
        $user = $this->user->getUser($userId);
        // dd($user);
        return view('clients.user-profile',compact('title','user'));
    }

    public function update(Request $req ){
        $fullName = $req->fullName;
        $address = $req->address;
        $email = $req->emai;
        $phone = $req->phone;
        return;

    }
}
