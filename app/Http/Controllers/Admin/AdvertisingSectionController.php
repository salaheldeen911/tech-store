<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdvertisingSectionRequest;
use App\Models\AdvertisingSection;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AdvertisingSectionController extends Controller
{
    public function index()
    {
        $advertisingSections = AdvertisingSection::all();
        $brands = Brand::all();
        $categoreis = Category::all();

        return view('admin.site.AdvertisingSection.index')->with(["brands" => $brands, "advertisingSections" => $advertisingSections, "categoreis" => $categoreis]);
    }

    public function update(UpdateAdvertisingSectionRequest $request)
    {
        try {
            $advertisingSection = AdvertisingSection::where("id", $request->id);
            $advertisingSection->update([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
            ]);

            if ($request->image) {
                if (File::exists(public_path($advertisingSection->first()->brand_main_image_path))) {
                    File::delete(public_path($advertisingSection->first()->brand_main_image_path));
                }

                $extention = $request->image->extension();
                $imgName = "brand_img_$request->id.$extention";
                $imgPath = "images/advertisingSections/brand_img_$request->id.$extention";
                $advertisingSection->update([
                    'brand_main_image_name' => $imgName,
                    'brand_main_image_path' => $imgPath,
                ]);

                $path = 'images/advertisingSections';
                $request->image->storeAs($path, $imgName);
            }

            if ($request->lable) {
                if (File::exists(public_path($advertisingSection->first()->brand_lable_image_path))) {
                    File::delete(public_path($advertisingSection->first()->brand_lable_image_path));
                }
                $extention = $request->lable->extension();
                $lableName = "brand_lable_$request->id.$extention";
                $lablePath = "images/advertisingSections/brand_lable_$request->id.$extention";
                $advertisingSection->update([
                    'brand_lable_image_name' => $lableName,
                    'brand_lable_image_path' => $lablePath,
                ]);
                $path = 'images/advertisingSections';
                $request->lable->storeAs($path, $lableName);
            }

            return response()->json(['message' => "success"]);
        } catch (\Exception $e) {
            Log::error("error while uptatting addvertising section.", ['error_msg' => $e->getMessage(), "trace" => $e->getTraceAsString()]);

            return response()->json(['message' => "failed"]);
        }
    }
}
