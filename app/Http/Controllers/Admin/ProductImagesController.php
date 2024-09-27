<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImageRequest;
use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ProductImagesController extends Controller
{
    public function store(ProductImageRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $imagePaths = [];

            foreach ($validatedData['images'] as $image) {
                // Ensure $image is a base64 string
                if (is_string($image['src'])) {
                    $path = storeImage($image['src']);
                    $imagePaths[] = $path;
                } else {
                    throw new \Exception('Image data should be a base64-encoded string.');
                }
            }

            foreach ($imagePaths as $path) {
                ProductImages::create([
                    'product_id' => $validatedData['product_id'],
                    'image_path' => $path,
                ]);
            }

            return response()->json(['message' => 'Images uploaded successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while uploading images', 'error' => $e->getMessage()], 500);
        }
    }

    public function index(Request $request)
    {
        $productId = $request->query('product_id');

        // Fetch images with id and image_path
        $images = ProductImages::where('product_id', $productId)
            ->select('id', 'image_path')
            ->get();

        // Convert the collection to an array
        $allImages = $images->toArray();

        // Map over the array to adjust the image path
        $allImages = array_map(function ($image) {
            // Ensure we update and return the image array with adjusted image path
            $image['image_path'] = URL::to($image['image_path']); // Adjust the path if needed
            return $image;
        }, $allImages);

        return response()->json($allImages);
    }


    public function destroy(int $imageId){

        $image = ProductImages::findOrFail($imageId);
        $image->delete();
        return response()->json(['message'=>'Image Deleted Successfully']);
    }

}
