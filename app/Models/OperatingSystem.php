<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatingSystem extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id'];

    const BASE_OPERATING_SYSTEM = [
        'mac',
        'android',
        'windows',
        'ios'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
