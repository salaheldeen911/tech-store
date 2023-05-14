<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    public function index()
    {
        $products = Product::with("details")->get();
        $sliders = Slider::get();
        return view('admin.site.slider.index')->with(['products' => $products, 'sliders' => $sliders]);
    }

    public function update(UpdateSliderRequest $request)
    {
        $slider = Slider::where("id", $request->id)->first();

        $this->authorize('update', $slider);
        try {
            $path = $slider->name;

            if (File::exists(public_path("images/sliders/$path"))) {
                File::delete(public_path("images/sliders/$path"));
            }
            $fileName = "slider_" . $slider->id;
            $extention = $request->file->extension();

            $slider->update([
                // "product_id" => $request->product_id,
                'image_name' => $fileName . '.' . $extention,
                'path' => 'images/sliders/' . $fileName . '.' . $extention,
            ]);

            $path = 'images/sliders';

            $request->file->storeAs($path, $fileName . '.' . $extention);

            return response()->json(['message' => "success"]);
        } catch (\Exception $e) {
            Log::error("error while updating slider.", ['error_msg' => $e->getMessage(), "trace" => $e->getTraceAsString()]);

            return response()->json(['message' => "failed"]);
        }
    }
}
