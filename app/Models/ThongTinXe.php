<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongTinXe extends Model
{
    use HasFactory;
    protected $table = 'thongtinxe';
    protected $primaryKey = 'maxe';


    public function thongSoKyThuatXeMay()
    {
        return $this->hasOne(ThongSoKyThuatXeMay::class, 'matsxemay', 'matsxemay');
    }

    public function dongXe()
    {
        return $this->belongsTo(DongXe::class, 'madx', 'madx');
    }

}
