<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;
    protected $table = "donhang";
    protected $fillable = ['madh, mathanhtoan, makhuyenamai, ngaytaodon, tongtien'];
    public $timestamps = false;
}
