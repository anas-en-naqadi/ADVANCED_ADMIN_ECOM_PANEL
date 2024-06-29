<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\WishListRequest;
use App\Models\WishList;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function index()
    {
        $wishlists = WishList::with('product')->orderByDesc('created_at')->get();
        return response()->json($wishlists);
    }


    public function store(WishListRequest $request)
    {
        $validatedData = $request->validated();
        CleanInputs($validatedData);

        $validatedData['user_id'] = getSimpleUser()->id;
        $wishList = WishList::create($validatedData);
        return $wishList ? response()->json(['message' => 'The product added to wishList successfully']) : response()->json(['message' => 'Oops, something went wrong'], 420);
    }
    public function destroy($id)
    {
        try {
            $cart = WishList::findOrFail($id);
            $cart->delete();
            return response()->json(['message' => 'Product deleted from wishList successfully']);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'wishList not found'], 404);
        }
    }
}
