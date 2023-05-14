<?php

namespace App\ProductSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class PriceRange
{
    public static function apply(Builder $builder, $value)
    {
        return $builder->whereBetween('final_price', $value);
    }
}
