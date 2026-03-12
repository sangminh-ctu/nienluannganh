<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Login;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class LoginGoogleController extends Controller
{

    protected $user;
    public function __construct()
    {
        $this->user = new Login();
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = $this->user->checkUserExistGoogle($user->id); //Kiểm tra xem thử có id người dùng với email này chưa
            // dd($finduser);
            if ($finduser) {
                session()->put('username', $finduser->username);
                session()->put('fullName', $finduser->fullName);

                return redirect()->intended('/');
            } else {
                $data_google = [
                    'google_id' => $user->id,
                    'fullName' => $user->name,
                    'username' => 'user-google-' . time(), // Nối thêm timestamp
                    'password' => bcrypt(Str::random(12)),
                    'email' => $user->email,
                    'isActive' => 'y'
                ];
                $newUser = $this->user->registerAcount($data_google);
                // Kiểm tra xem $newUser có hợp lệ không
                if ($newUser && isset($newUser->username)) {
                    // Lưu thông tin người dùng mới vào session
                    session()->put('username', $newUser->username);
                    session()->put('fullName', $newUser->fullName);
                    return redirect()->intended('/');
                } else {
                    // Nếu có lỗi khi đăng ký người dùng mới, xử lý lỗi
                    return redirect()->back()->with('error', 'Có lỗi xảy ra trong quá trình đăng ký người dùng mới');
                }
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
