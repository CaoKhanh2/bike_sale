<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DongXe extends Model
{
    use HasFactory;
    protected $table = "dongxe";
    protected $primaryKey = 'madx';


    public function thongTinXe()
    {
        return $this->hasMany(ThongTinXe::class, 'madx', 'madx');
    }

    public function hangXe()
    {
        return $this->belongsTo(HangXe::class, 'mahx', 'mahx');
    }
}
