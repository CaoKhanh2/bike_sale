<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    use HasFactory;
    protected $table = "giohang";
    public $timestamps = false;

    public function Giohang()
    {
        return $this->belongsTo(XeDangBan::class,'prod_id','id');
    }
}
