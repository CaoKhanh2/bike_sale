<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongSoKyThuatXeMay extends Model
{
    use HasFactory;
    protected $table = 'thongsokythuatxemay';
    protected $primaryKey = 'matsxemay';

    public function thongTinXe()
    {
        return $this->belongsTo(ThongTinXe::class, 'matsxemay', 'matsxemay');
    }
}
