<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CategoryController extends Controller
{

    public function index()
    {
        $cacheKey = 'categories';
        $cacheData = getCachedData($cacheKey, function () {
        $categories = Category::all();
        return $categories;
        });
        return response()->json($cacheData);

    }

    public function store(CategoryRequest $request)
    {

        $validatedData = $request->validated();
        CleanInputs($validatedData);
        $category =  Category::create($validatedData);
        Redis::del('categories');

        return $category ? response()->json('new category added successfully !!',200) : response()->json('oops, something went wrong!!',500);
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            Redis::del('categories');

            return response()->json(['message' => 'la categorie a ete supprime avec success']);
        } catch (ModelNotFoundException $message) {
            return response()->json(['message' => 'Oops, something went wrong !!']);
        }
    }
}
