<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Để dùng Bcrypt thay cho MD5
use Illuminate\Support\Facades\File; // Để xóa file an toàn

class AdminManagementController extends Controller
{
    private $admin;

    public function __construct()
    {
        $this->admin = new AdminModel();
    }

    public function index()
    {
        $title = 'Quản lý Admin';
        // Lấy username từ session để tìm đúng admin trong bảng tbl_users
        $username = session('admin');
        $admin = $this->admin->getAdmin($username);

        return view('admin.profile-admin', compact('title', 'admin'));
    }

    public function updateAdmin(Request $request)
    {
        $username = session('admin');
        $fullName = $request->fullName;
        $password = $request->password;
        $email = $request->email;
        $address = $request->address;

        $admin = $this->admin->getAdmin($username);
        
        $dataUpdate = [
            'fullName' => $fullName,
            'email' => $email,
            'address' => $address
        ];

        // KIỂM TRA MẬT KHẨU: Nếu user nhập mật khẩu mới khác với mật khẩu cũ (Bcrypt)
        if (!Hash::check($password, $admin->password)) {
            $dataUpdate['password'] = Hash::make($password); // Mã hóa Bcrypt chuẩn Laravel
        }

        $update = $this->admin->updateAdmin($username, $dataUpdate);
        
        if ($update) {
            $newinfo = $this->admin->getAdmin($username);
            // Cập nhật lại FullName trong session để Header hiển thị đúng ngay lập tức
            session(['admin_fullname' => $newinfo->fullName]);
            
            return response()->json(['success' => true, 'data' => $newinfo]);
        } else {
            return response()->json(['success' => false, 'message' => 'Không có thông tin nào thay đổi!']);
        }
    }

    public function updateAvatar(Request $req)
    {
        if ($req->hasFile('avatarAdmin')) {
            $username = session('admin');
            $avatar = $req->file('avatarAdmin');

            // Tạo tên file duy nhất để tránh bị cache trình duyệt (ví dụ: admin_173356.jpg)
            $filename = 'admin_' . time() . '.' . $avatar->getClientOriginalExtension();
            $path = public_path('admin/assets/images/user-profile/');

            // Xóa ảnh cũ nếu tồn tại trong thư mục
            $admin = $this->admin->getAdmin($username);
            if ($admin->avatar && File::exists($path . $admin->avatar)) {
                File::delete($path . $admin->avatar);
            }

            // Lưu ảnh mới
            $avatar->move($path, $filename);

            // Cập nhật tên ảnh mới vào database bảng tbl_users
            $this->admin->updateAdmin($username, ['avatar' => $filename]);
            session(['admin_avatar' => $filename]); // Cập nhật session cho Sidebar

            return response()->json(['success' => true, 'message' => 'Cập nhật ảnh thành công!', 'avatar' => $filename]);
        }
        
        return response()->json(['error' => true, 'message' => 'Vui lòng chọn ảnh!']);
    }
}