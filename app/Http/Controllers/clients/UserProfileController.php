<?php

namespace App\Http\Controllers\clients;
use Illuminate\Support\Facades\Hash;
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

    public function getUserId(){
        if(!session()->has('userId')){
            $username = session()->get('username');
            if($username){
                $userId = $this->user->getUserId($username);
                session()->put('userId',$userId); //Lưu userId vào session để dùng lại
            }
        }
        return session()->get('userId');
    }

   public function index()
{
    $title = 'Thông tin cá nhân';
    $userId = $this->getUserId();

    // 1. Nếu không lấy được ID (chưa đăng nhập hoặc session hết hạn)
    if (!$userId) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem thông tin.');
    }

    $user = $this->user->getUser($userId);

    // 2. Nếu có ID nhưng tìm trong DB không ra User (User đã bị xóa hoặc ID sai)
    if (!$user) {
        // Xóa session cũ đi vì nó không còn đúng nữa
        session()->forget(['userId', 'username']);
        return redirect()->route('login')->with('error', 'Tài khoản không tồn tại.');
    }

    return view('clients.user-profile', compact('title', 'user'));
}

    public function update(Request $req)
    {
        $fullName = $req->fullName;
        $address = $req->address;
        $email = $req->email;
        $phone = $req->phone;
        

        $dataUpdate = [
            'fullName' => $fullName,
            'address' => $address,
            'email' => $email,
            'phoneNumber' => $phone,

        ];
        $userId = $this->getUserId();
        $update = $this->user->updateUser($userId, $dataUpdate);

        if (!$update) {
            return response()->json([
                'fail' => false,
            ]);
        }

        // dd($dataUpdate);
        return response()->json([
            'success' => true,  
              
        ]);
    }

    public function changePassword(Request $req){

        // 1. Lấy thông tin User
    $userId = $this->getUserId();
    $user = $this->user->getUser($userId);



    // 2. Kiểm tra mật khẩu cũ (Dùng Hash::)
    if (Hash::check($req->oldPass, $user->password)) {


        // 3. Cập nhật mật khẩu mới (Dùng Hash::make thay cho md5())
        $update = $this->user->updateUser($userId, [
            'password' => Hash::make($req->newPass),
            // 'updated_at' => now()
        ]);

        
        return response()->json([
            'success' => true, 
            'message' => 'Đổi mật khẩu thành công rồi nhé Sang!'
        ]);

    } else {
        // Trả về lỗi 422 để Ajax bóc tách lỗi chi tiết cho chuyên nghiệp
        return response()->json([
            'success' => false, 
            'message' => 'Mật khẩu cũ không chính xác.'
        ], 422);
    }

     }
}
