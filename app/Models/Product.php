<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
    [
        "name",
        'title',
        "used",
        "category_id",
        "main_image",
        "price",
        "discount",
        "final_price",
        "discount_percent",
        "seller_id",
        "likes",
        "color_id",
        "old_price",
        "brand_id",
        "quantity",
        "sold",
        "deleted_at"
    ];

    public function likes()
    {
        return $this->hasMany(Like::class, 'product_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function details()
    {
        return $this->hasOne(ProductDetail::class, 'product_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, "seller_id");
    }

    public function color()
    {
        return $this->belongsTo(Color::class, "color_id");
    }

    public function scopeWelcomeProduct(Builder $query): void
    {
        $query->with("brand:id,name", "color:id,name")
            ->select("id", "name", "brand_id", "color_id", "final_price", "main_image", "discount_percent", "discount", "likes", "used", "price");
    }

    public function scopeIsActive(Builder $query): void
    {
        $query->where("quantity", ">", 0);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function subImages()
    {
        return $this->hasMany(SubImage::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public static $mobileCategory = 1;
    public static $tvCategory = 2;
    public static $laptopCategory = 3;

    public static function latestProducts()
    {
        return Product::latest()->take(4)->get();
    }

    public static function tvProducts()
    {
        $tvs = Product::inRandomOrder()->where('category_id', self::$tvCategory)->take(4)->get();
        return $tvs;
    }

    public static function mobileProducts()
    {
        $mobiles = Product::inRandomOrder()->where('category_id', self::$mobileCategory)->take(4)->get();

        return $mobiles;
    }

    public static function laptopProducts()
    {
        $laptops = Product::inRandomOrder()->where('category_id', self::$laptopCategory)->take(4)->get();

        return $laptops;
    }

    public static function bestSellerrProducts()
    {
        $best = Product::orderBy("sold", "desc")->take(4)->get();

        return $best;
    }

    static function getProduct($product_id)
    {
        return Product::where('id', $product_id)->first();
    }
}
