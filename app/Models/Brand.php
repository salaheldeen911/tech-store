<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    const BASE_BRANDS = [
        'OPPO',
        'XIAOMI',
        'HUAWEI',
        'HP',
        'APPLE',
        'LG',
        'SAMSUNG',
        'VIVO',
        'NOKIA',
        'LENOVO',
        'GOOGLE',
        'ONEPLUS',
        'HTC',
        'SONY',
        'ALCATEL',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
