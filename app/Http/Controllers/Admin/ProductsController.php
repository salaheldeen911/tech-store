<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use App\Http\Services\ProductService;
use App\Models\Rating;

class ProductsController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }

    public function showAllProducts(Request $request, ProductService $service)
    {
        if ($request->ajax()) {
            $data = Product::orderBy('id', 'DESC')->get();

            return $service->dataTable($data);
        }
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        return view("admin.products.create");
    }

    public function show(Product $product)
    {
        $this->authorize('view', $product);

        return view("admin.products.show")->with(["product" => $product]);
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        return view("admin.products.edit")->with(["product" => $product]);
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $path = $this->path($product->category_id, $product->id);
        if (File::isDirectory($path)) {
            File::deleteDirectory($path);
        }

        $product->delete();
        return redirect()->route('admin.products.index');
    }

    public function destroyRateing($id)
    {
        Rating::find($id)->delete();

        return redirect()->back();
    }

    private function path($category_id, $product_id)
    {
        return public_path("images/products/$category_id/$product_id");
    }
}
