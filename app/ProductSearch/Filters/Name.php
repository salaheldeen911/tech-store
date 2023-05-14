<?php

namespace App\ProductSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Name
{
    public static function apply(Builder $builder, $value)
    {
        return $builder
            ->where('name', 'like', '%' . $value . '%')
            ->orWhere('title', 'like', '%' . $value . '%')
            ->orWhereRelation("brand", "name", "like", '%' . $value . '%')
            ->orWhereRelation("category", "name", "like", '%' . $value . '%')
            ->orWhereRelation("details", "description", "like", '%' . $value . '%');
    }
}
