<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    const BASE_PROCESSOR = [
        'Qualcomm Snapdragon',
        'Apple A16 Bionic',
        'Snapdragon 8 Gen 2',
        'Snapdragon 8 Plus Gen 1',
        'Dimensity 9200',
        'Dimensity 9000 Plus',
        'Apple A15 Bionic',
        'Dimensity 9000',
        'Snapdragon 8 Gen 1',
        'Apple A14 Bionic',
        'Snapdragon 888 Plus',
        'Exynos 2200',
        'Snapdragon 888',
        'Dimensity 8100',
        'Tensor G2',
        'Exynos 2100',
        'Google Tensor',
        'Apple A13 Bionic',
        'Kirin 9000',
        'Kirin 9000E',
        'Exynos 1080',
        'Snapdragon 870',
        'Snapdragon 865+',
        'Dimensity 1200',
        'Snapdragon 865',
        'Dimensity 1100',
        'Snapdragon 780G',
        'Dimensity 1000+',
        'Apple A12 Bionic',
        'Dimensity 1000',
        'Snapdragon 855+',
        'Snapdragon 860',
        'Exynos 990',
        'Snapdragon 778G Plus',
        'Snapdragon 855',
        'Snapdragon 778G',
        'Intel Core i7',
        'Intel Core i6',
        'Intel Core i5',
        'Intel Core i4',
        'Intel Core i3'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
