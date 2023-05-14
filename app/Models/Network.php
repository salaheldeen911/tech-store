<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id'];

    const BASE_NETWORK = [
        '2G',
        '3G',
        '4G',
        '5G'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
