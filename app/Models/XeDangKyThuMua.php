<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XeDangKyThuMua extends Model
{
    use HasFactory;
    protected $table = 'xedangkythumua';
    protected $primarykey = 'madkthumua';
    public $timestamps = false;
    
}
