<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function store(CategoryRequest $request)
    {

        $validatedData = $request->validated();
        CleanInputs($validatedData);
        $category =  Category::create($validatedData);
        return $category ? response()->json('new category added successfully !!',200) : response()->json('oops, something went wrong!!',500);
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json(['message' => 'la categorie a ete supprime avec success']);
        } catch (ModelNotFoundException $message) {
            return response()->json(['message' => 'Oops, something went wrong !!']);
        }
    }
}
