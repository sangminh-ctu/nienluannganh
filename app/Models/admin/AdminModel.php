<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminModel extends Model
{
    use HasFactory;

    // PHẢI LÀ tbl_users vì admin của Sang nằm ở đây
    protected $table = 'tbl_users'; 

    /**
     * Lấy thông tin admin dựa trên username lưu trong session
     */
    public function getAdmin($username){
        return DB::table($this->table)
            ->where('username', $username)
            ->where('role', 1) // Đảm bảo đúng là admin
            ->first();
    }

    /**
     * Cập nhật thông tin admin
     */
    public function updateAdmin($username, $data){
        return DB::table($this->table)
            ->where('username', $username)
            ->where('role', 1)
            ->update($data);
    }
}