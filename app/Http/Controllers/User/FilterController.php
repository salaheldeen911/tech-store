<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\ProductSearch\ProductsSearch;

class FilterController extends Controller
{
    public function filter(Request $request)
    {
        $products =  ProductsSearch::apply($request);
        return view('user.products.index')->with([
            'products' => $products,
            "response" => $request->all(),
            "categories" => Category::all(),
            "brands" => Brand::all(),
        ]);
    }
}
