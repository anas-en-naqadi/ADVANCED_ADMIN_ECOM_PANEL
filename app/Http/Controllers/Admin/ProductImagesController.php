<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImageRequest;
use App\Models\ProductImages;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    public function store(ProductImageRequest $request)
    {
        dd($request);
        $validatedData = $request->validated();
        try {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                $path =  storeImage($image);
                $validatedData['image_path'] = $path;
                ProductImages::create($validatedData);
                }
                return response()->json(['message' => 'Images uploaded successfully']);
            } else {
                return response()->json(['message' => 'No images uploaded'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while uploading images'], 500);
        }
    }

}
