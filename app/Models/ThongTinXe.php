<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongTinXe extends Model
{
    use HasFactory;
    protected $table = 'thongtinxe';

    protected $fillable = [
        'maxe',
        'madx',
        'matsxemay',
        'matsxedapdien',
        'tenxe',
        'thoigiandasudung',
        'tinhtrangxe',
        'sokmdadi',
        'hinhanh',
        'biensoxe',
        'ghichu',
    ];

}
