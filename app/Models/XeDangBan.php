<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XeDangBan extends Model
{
    use HasFactory;
    protected $table = "xedangban";

    protected $fillable = [
        'maxedangban',
        'maxe',
        'giaban',
        'mota',
        'tranghthai',
    ];
    public function thongtinxe()
    {
        return $this->belongsTo(ThongTinXe::class, 'maxe', 'maxe');
    }

}
