<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietGioHang extends Model
{
    use HasFactory;
    protected $table = "ctgiohang";

    public $timestamps = false;

    // protected $fillable = [
    //     'magh',
    //     'maxe',
    //     'soluong',
    //     'dongia',
    // ];

    // public function xedangban()
    // {
    //     return $this->belongsTo(XeDangBan::class,'maxe','maxe');
    // }

    // public function giohang()
    // {
    //     return $this->belongsTo(GioHang::class,'magh','magh');
    // }
}
