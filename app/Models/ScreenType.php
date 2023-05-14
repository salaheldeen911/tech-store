<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScreenType extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    const BASE_SCREEN_TYPE = [
        'LCD',
        'LED',
        'OLED',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
