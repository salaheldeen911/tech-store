<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisingSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        "brand_id",
        'brand_main_image_name',
        'brand_lable_image_name',
        'brand_main_image_path',
        'brand_lable_image_path',
        'brand_order'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
