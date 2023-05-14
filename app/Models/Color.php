<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id'];

    const BASE_COLORS = [
        "Black",
        "Green",
        "White",
        "Gold",
        "Silver",
        "Red",
        "Blue",
        "Pink",
        "Yellow"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
