<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefreshRate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    const BASE_REFRESH_RATE = [
        '60',
        '120',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
