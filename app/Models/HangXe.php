<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HangXe extends Model
{
    use HasFactory;
    protected $table = "hangxe";
    protected $primaryKey = 'mahx';


    public function dongXe()
    {
        return $this->hasMany(DongXe::class, 'mahx', 'mahx');
    }
}
