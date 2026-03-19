<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LoginModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_users';

    /**
     * Tìm kiếm người dùng có quyền Admin dựa trên username
     */
    public function login($username)
    {
        // CHỈ tìm theo username và role = 1
        // KHÔNG tìm theo password ở đây vì password đã mã hóa Bcrypt
        return DB::table($this->table)
            ->where('username', $username)
            ->where('role', 1) 
            ->first();
    }
}