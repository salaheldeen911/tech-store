<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::isActive()
            ->welcomeProduct()
            ->inRandomOrder()
            ->paginate(6);

        return view("user.products.index")->with([
            "products" => $products,
            "categories" => Category::all(),
            "brands" => Brand::all(),
        ]);
    }

    public function show($id)
    {
        $product = Product::with("details")->find($id);
        return view("user.products.show")->with("product", $product);
    }
}
