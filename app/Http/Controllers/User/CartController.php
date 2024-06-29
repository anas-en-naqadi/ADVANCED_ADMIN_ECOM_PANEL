<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartController extends Controller
{
    public function index()
    {
        $product_cart = Cart::with(['product' => function ($query) {
            $query->select('id', 'product_name', 'price', 'image');
        }])->get(['quantity', 'product_id']);
        return response()->json($product_cart);
    }

    public function store(CartRequest $request)
    {
        $validatedData = $request->validated();
        CleanInputs($validatedData);

        $validatedData['user_id'] = getSimpleUser()->id;
        $cart = Cart::create($validatedData);

        return $cart ?  response()->json(['message' => 'Cart item added successfully','cart_count' => count(Cart::all())]) :
            response()->json(['message' => 'something went wrong'], 420);
    }

    public function totalAmount()
    {
        $cartItems = Cart::with(['product' => function ($query) {
            $query->select('price');
        }])->get(['product_id', 'quantity']);
        $totalAmount = $cartItems->sum(function ($cartItem) {
            return $cartItem->quantity * $cartItem->product->price;
        });
        return $totalAmount;
    }

    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json(['product' => $product]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $cart = Cart::findOrFail($id);
            $cart->delete();
            return response()->json(['message' => 'Cart item deleted successfully']);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
    }

    public function incrementQuantity(Request $request)
    {
        try {
            $id = $request->validate(['product_id' => 'required|numeric']);

            Cart::findOrFail($id)->increment('quantity');
            return response()->json(['message' => 'Quantity updated successfully']);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
    public function decrementQuantity(Request $request)
    {
        try {
            $id = $request->validate(['product_id' => 'required|numeric']);

            Cart::findOrFail($id)->decrement('quantity');
            return response()->json(['message' => 'Quantity updated successfully']);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
}
