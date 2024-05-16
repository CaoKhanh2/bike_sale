<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    use HasFactory;
    protected $table = "giohang";

    protected $fillable = [
        'magh',
        'mand',
        'tongtien',
    ];

    // public function xedangban()
    // {
    //     return $this->belongsTo(XeDangBan::class,'maxe','maxe');
    // }
 
    public function giohang()
    {
        return $this->belongsTo(NguoiDung::class,'magh','mand');
    }
    public $timestamps = false;
}
