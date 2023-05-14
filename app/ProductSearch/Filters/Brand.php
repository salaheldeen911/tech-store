<?php

namespace App\ProductSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Brand
{
    public static function apply(Builder $builder, $value)
    {
        return $builder->whereIn('brand_id', $value);
    }
}
