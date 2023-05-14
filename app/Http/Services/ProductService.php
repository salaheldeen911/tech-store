<?php

namespace App\Http\Services;

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubImage;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class ProductService
{
    private $imagesPath = "images/products";

    public function storeImages($product, $images)
    {
        $i = 0;
        foreach ($images as $img) {
            if ($i == 0) {
                $i = 1;
                $this->saveMainImage($product, $img);
                continue;
            }
            $this->saveSubImage($product, $img);
        }
    }

    public function updateImages($product, $images)
    {
        $path = $this->directoryPath($product->category_id, $product->id);
        SubImage::where("product_id", $product->id)->delete();
        if (File::isDirectory($path)) {
            File::deleteDirectory($path);
        }
        $i = 0;
        foreach ($images as $img) {
            if ($i == 0) {
                $i = 1;
                $this->saveMainImage($product, $img);
                continue;
            }
            $this->saveSubImage($product, $img);
        }
    }

    private function MainImgName($product, $mainImage)
    {
        return "$this->imagesPath/$product->category_id/$product->id/main-$product->id-" . uniqid() . "." . $mainImage->extension();
    }

    private function SubImgName($product, $subImage)
    {
        return "$this->imagesPath/$product->category_id/$product->id/sub-$product->id-" . uniqid() . "." . $subImage->extension();
    }

    private function saveMainImage($product, $mainImage)
    {
        $MainImgName = $this->MainImgName($product, $mainImage);
        $mainImage->storeAs("", $MainImgName);
        $product->update([
            "main_image" => $MainImgName,
        ]);
    }

    private function saveSubImage($product, $img)
    {
        $subImgName = $this->SubImgName($product, $img);
        SubImage::create([
            "product_id" => $product->id,
            "sub_image" => $subImgName,
        ]);
        $img->storeAs("", $subImgName);
    }

    private function directoryPath($category_id, $product_id)
    {
        return public_path("images/products/$category_id/$product_id");
    }

    public function dataTable($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn("action", function ($row) {
                return $this->addColumn($row);
            })
            ->addColumn("publisher_email", function ($row) {
                return User::select("email")->find($row->seller_id)->email;
            })
            ->setRowId(function ($product) {
                return $product->id;
            })
            ->setRowAttr([
                "align" => "center",
            ])
            ->rawColumns(["action"])
            ->editColumn("updated_at", function ($row) {
                return $row->updated_at->diffForHumans();
            })
            ->editColumn("created_at", function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->editColumn("brand", function ($row) {
                return Brand::select("name")->find($row->brand_id)->name;
            })
            ->editColumn("category", function ($row) {
                return Category::select("name")->find($row->category_id)->name;
            })
            ->make(true);
    }

    private function addColumn($row)
    {
        $colomn = "<a href='products/$row->id'>
                <span class='jsgrid-button jsgrid-edit-button ti-eye' type='button' title='Show'></span>
            </a>";
        if (can($row->seller_id)) {
            $colomn .=
                "<a href='products/$row->id/edit'>
                <span class='jsgrid-button jsgrid-edit-button ti-pencil' type='button' title='Edit'></span>
            </a>
            <a href='javascript:void(0)' onclick='deleteProduct(this)'>
                    <span class='jsgrid-button jsgrid-delete-button ti-trash' type='button' title='Delete'></span>
            </a>

            <form action='products/$row->id' method='POST' style='display: none'>
                " . csrf_field() . "
                " . method_field("DELETE") . "
                
            </form>";
        }
        return $colomn;
    }

    function can($id)
    {
        return auth()->user()->id == $id || auth()->user()->hasRole("super_admin") ? true : false;
    }
}
