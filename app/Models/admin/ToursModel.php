<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ToursModel extends Model
{
    protected $table = 'tbl_tour';
    protected $primaryKey = 'tourId';
    public $timestamps = false;

    // Lấy toàn bộ danh sách tour
    public function getAllTours() {
        return DB::table($this->table)->orderBy('tourId', 'desc')->get();
    }

    // Tạo tour mới và trả về ID vừa tạo
    public function createTours($data) {
        return DB::table($this->table)->insertGetId($data);
    }

    // Lưu hình ảnh vào bảng tbl_images
    public function uploadImages($data) {
        return DB::table('tbl_images')->insert($data);
    }

    // Thêm lộ trình vào bảng tbl_timeline
    public function addTimeLine($data) {
        return DB::table('tbl_timeline')->insert($data);
    }

    // Cập nhật trạng thái hoặc thông tin tour
    public function updateTour($id, $data) {
        return DB::table($this->table)->where('tourId', $id)->update($data);
    }

    // Xóa tour (Cẩn thận vì có khóa ngoại)
    public function deleteTour($id) {
        try {
            DB::table('tbl_images')->where('tourId', $id)->delete();
            DB::table('tbl_timeline')->where('tourId', $id)->delete();
            DB::table($this->table)->where('tourId', $id)->delete();
            return ['success' => true, 'message' => 'Xóa tour thành công!'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Không thể xóa vì tour đã có khách đặt!'];
        }
    }
}