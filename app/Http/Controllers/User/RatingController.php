<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RateProductRequest;
use App\Models\Rating;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(RateProductRequest $request)
    {
        if (Rating::where(['product_id' => $request->product_id, "user_id" => auth()->user()->id])->exists()) {
            return response()->json(['message' => 'this product is rate thos product'], 409);
        }

        Rating::create([
            "product_id" => $request->input(('product_id')),
            "rating" => $request->input(('rate')),
            "review" => $request->input(('review')),
            "user_id" => auth()->user()->id
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        Rating::destroy($id);

        return redirect()->back();
    }
}
