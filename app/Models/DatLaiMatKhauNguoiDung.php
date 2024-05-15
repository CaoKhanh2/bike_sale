<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Finder\Iterator\CustomFilterIterator;

class DatLaiMatKhauNguoiDung extends Model
{
    use HasFactory;
    protected $table = "password_resets";

    protected $fillable = [
        'email',
        'token',
    ];

    public function customer(){
        return $this->hasOne(NguoiDung::class, 'email', 'email');
    }

    public function scopeCheckToken($q, $token){
        return $q->where('token', $token)->firstOrFail();
    }
}
