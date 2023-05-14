<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    const BASE_RESOLUTION = [
        'FHD',
        'ULTRA HD',
        '4K',
        '8K'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
