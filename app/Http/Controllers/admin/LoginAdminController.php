<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Thêm để dùng DB builder

class LoginAdminController extends Controller
{
    private $login;

    public function __construct()
    {
        $this->login = new LoginModel();
    }

    public function index()
    {
        // Nếu đã đăng nhập admin rồi thì không cho vào trang login nữa, đẩy thẳng vào dashboard
        if (session()->has('admin')) {
            return redirect()->route('admin.dashboard');
        }
        
        $title = 'Đăng nhập hệ thống';
        return view('admin.login', compact('title'));
    }

    // public function loginAdmin(Request $request)
    // {
    //     $username = $request->username;
    //     $password = $request->password;

    //     // Tìm user có role = 1 (Admin)
    //     $user = DB::table('tbl_users')
    //                 ->where('username', $username)
    //                 ->where('role', 1) 
    //                 ->first();

    //     if ($user && Hash::check($password, $user->password)) {
    //         // LƯU ĐẦY ĐỦ THÔNG TIN VÀO SESSION
    //         $request->session()->put('admin', $user->username);
    //         $request->session()->put('admin_id', $user->userId);
    //         $request->session()->put('admin_avatar', $user->avatar);
    //         $request->session()->put('admin_fullname', $user->fullName);

    //         // Quan trọng: Dùng intended để quay lại trang định vào trước đó hoặc vào dashboard
    //         return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công!');
    //     } else {
    //         return redirect()->route('admin.login')->with('error', 'Tài khoản không chính xác hoặc không có quyền Admin');
    //     }
    // }

    public function loginAdmin(Request $request)
{
    $username = $request->username;
    $password = $request->password;

    // Tìm user có role = 1 (Admin) trong bảng tbl_users
    $user = DB::table('tbl_users')
                ->where('username', $username)
                ->where('role', 1) 
                ->first();

    if ($user && Hash::check($password, $user->password)) {
        // LƯU ĐẦY ĐỦ THÔNG TIN VÀO SESSION
        $request->session()->put('admin', $user->username);
        $request->session()->put('admin_id', $user->userId);
        $request->session()->put('admin_avatar', $user->avatar);
        $request->session()->put('admin_fullname', $user->fullName);

        // THÊM DÒNG NÀY: Ép Laravel lưu session vào file/database ngay lập tức
        $request->session()->save(); 

        // SỬA DÒNG NÀY: Dùng redirect trực tiếp đến URL Dashboard
        return redirect('/admin/dashboard')->with('success', 'Chào mừng Admin quay trở lại!');
    } else {
        return redirect()->route('admin.login')->with('error', 'Tài khoản không chính xác hoặc không có quyền Admin');
    }
}

    public function logout(Request $request)
    {
        // Xóa toàn bộ session liên quan đến admin
        $request->session()->forget(['admin', 'admin_id', 'admin_avatar', 'admin_fullname']);
        return redirect()->route('admin.login')->with('success', 'Đã đăng xuất an toàn!');
    }
}