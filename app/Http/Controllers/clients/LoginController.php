<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    private $login;
    private $user;

    public function __construct()
    {
        $this->login = new \App\Models\clients\Login();
        $this->user = new \App\Models\clients\User();
    }

    public function index()
    {
        $title = 'Đăng nhập';
        return view('clients.login', compact('title'));
    }



    public function register(Request $request)
    {
        $username_regis = $request->username_regis;
        $email = $request->email;
        $password_regis = $request->password_regis;

        $checkAccountExist = $this->login->checkUserExist($username_regis, $email);
        if ($checkAccountExist) {
            return response()->json([
                'success' => false,
                'message' => 'Tên người dùng hoặc email đã tồn tại!'
            ]);
        }

        $activation_token = Str::random(60); // Tạo token ngẫu nhiên
        // Nếu không tồn tại, thực hiện đăng ký
        $dataInsert = [
            'username'         => $username_regis,
            'email'            => $email,
            'password'         => bcrypt($password_regis),
            'activation_token' => $activation_token
        ];

        $this->login->registerAcount($dataInsert);

        // Gửi email kích hoạt
        $this->sendActivationEmail($email, $activation_token);

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.'
        ]);
    }

    public function sendActivationEmail($email, $token)
    {
        $activation_link = route('activate.account', ['token' => $token]);

        Mail::send('clients.mail.emails_activation', ['link' => $activation_link], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Kích hoạt tài khoản của bạn');
        });
    }

    public function activateAccount($token)
    {
        $user = $this->login->getUserByToken($token);
        if ($user) {
            $this->login->activateUserAccount($token);

            return redirect('/login')->with('message', 'Tài khoản của bạn đã được kích hoạt!');
        } else {
            return redirect('/login')->with('error', 'Mã kích hoạt không hợp lệ!');
        }
    }




    // public function login(Request $request)
    // {
    //     $username = $request->username;
    //     $password = $request->password; // Mật khẩu thô khách nhập

    //     $data_login = [
    //         'username' => $username,
    //         // 'password' => md5($password)
    //     ];

    //     $user_login = $this->login->login($data_login);
    //     $userId = $this->user->getUserId($username);
    //     $user = $this->user->getUser($userId);
       

    //     // 1. Lấy user từ DB qua Model
    //     $user = $this->login->login(['username' => $username]);
    //     // 2. Kiểm tra: Có user không? Pass có khớp không?
    //     if ($user && Hash::check($password, $user->password)) {
    //        // Kiểm tra thêm isActive 
    //         if ($user->isActive != 'y') {
    //             return response()->json(['success' => false, 'message' => 'Tài khoản chưa kích hoạt!']);
    //         }

    //         $request->session()->put('username', $user->username);
    //         $request->session()->put('username', $user->avatar);
    //         // Lưu thêm role hoặc id 
    //         // $request->session()->put('role', $user->role);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Đăng nhập thành công!',
    //             'redirectUrl' => route('home'),
    //         ]);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Tên đăng nhập hoặc mật khẩu không chính xác!',
    //         ]);
    //     }
    // }


    public function login(Request $request)
{
    $username = $request->username;
    $password = $request->password; 

    // 1. Lấy user từ DB qua Model (Chỉ tìm theo username)
    $user = $this->login->login(['username' => $username]);

    // 2. Kiểm tra: Có user không? Mật khẩu Bcrypt có khớp không?
    if ($user && Hash::check($password, $user->password)) {
        
        // 3. Kiểm tra trạng thái kích hoạt (nếu Sang có làm tính năng này)
        if (isset($user->isActive) && $user->isActive != 'y') {
            return response()->json([
                'success' => false, 
                'message' => 'Tài khoản của Sang chưa được kích hoạt!'
            ]);
        }

        // 4. LƯU SESSION - QUAN TRỌNG NHẤT LÀ ĐOẠN NÀY
        $request->session()->put('userId', $user->userId);     // ID để dùng cho trang Profile
        $request->session()->put('username', $user->username); // Tên để hiển thị chào hỏi
        $request->session()->put('avatar', $user->avatar);     // Lưu vào key 'avatar', không ghi đè vào 'username'
        $request->session()->put('role', $user->role ?? 'user'); 

        return response()->json([
            'success' => true,
            'message' => 'Đăng nhập thành công! Đang vào hệ thống...',
            'redirectUrl' => route('home'),
        ]);
    } else {
        // Sai username hoặc sai pass đều báo chung để bảo mật
        return response()->json([
            'success' => false,
            'message' => 'Tên đăng nhập hoặc mật khẩu không chính xác!',
        ]);
    }
}

    //xử lý đăng xuất
    public function logout(Request $request)
    {
        // 1. Xóa sạch session
        $request->session()->flush();
        // 2. Redirect về home kèm theo một message "flash"
        return redirect()->route('home')->with('success_logout', 'Đăng xuất thành công!');
    }
}
