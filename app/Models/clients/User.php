<?php

namespace App\Models\clients;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'tbl_users';

    public function getUserID($username){
        return DB::table($this->table)
        ->select('userId')
        ->where('username',$username)->value('userId');
    }

    public function getUser($id){
        $user = DB::table($this->table)
        ->where('userId',$id)->first();
        return $user;
    }

    public function updateUser($id, $data) {
        return DB::table($this->table)
            ->where('userId', $id)
            ->update($data);
    }

}

