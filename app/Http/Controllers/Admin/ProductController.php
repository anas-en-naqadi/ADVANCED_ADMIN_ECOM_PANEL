<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\User;

use App\Notifications\StockAlertNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller
{
    public function index()
    {
        $cacheKey = 'products';
        $cacheData = getCachedData($cacheKey, function () {
        $products = Product::with('reviews', 'category')->latest()->get();

        foreach ($products as $product) {
            if (!empty($product->image)) {
                $product->image = URL::to($product->image);
            }

        }
        return $products;
    });
    return response()->json($cacheData);
    }



    public function store(ProductRequest $request)
    {
        $validatedData['user_id'] = 81;
        $validatedData = $request->validated();
        CleanInputs($validatedData);

        cleanInputs($validatedData);
        if (isset($validatedData['image'])) {
            $validatedData['image'] = storeImage($validatedData['image']);
        }
        // $validatedData['user_id'] = getSimpleUser()->id;
        Product::create($validatedData);
        Redis::del('key');
        return response()->json(['message' => 'Product added successfully']);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $validatedData['user_id'] = 81;
        $validatedData = $request->validated();
        CleanInputs($validatedData);

        cleanInputs($validatedData);
        if (isset($validatedData['image']) && preg_match('/^data:image\/(\w+);base64,/', $validatedData['image'], $type)) {

            $validatedData['image'] = storeImage($validatedData['image']);

            if ($product->image) {
                File::delete(public_path($product->image));
            }
        }

        // Update the product
        $product->update($validatedData);
        Redis::del('key');
        return response()->json(['message' => 'product item updated successfully']);
    }

    public function show($id)
    {
        try {

            $product = Product::with('images', 'category', 'reviews')->findOrFail($id);
            $product->image = URL::to($product->image);
            return response()->json($product);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            if ($product->image) {
                File::delete(public_path($product->image));
            }
            Redis::del('key');
            return response()->json(['message' => 'product deleted successfully']);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'product not found'], 404);
        }
    }

    public function searchQuery(Request $request)
    {
        $query = $request->validate(['query' => 'required|string'])['query'];

        $products = Product::where('product_name', 'LIKE', '%' . $query . '%')->get(['product_name', 'product_id']);

        if ($products->isEmpty()) {
            return response()->json(['message' => 'Product not found'], 404);
        } else {
            return response()->json($products);
        }
    }
}
