<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\Shipping;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ShippingController extends Controller
{
    public function index()
    {
        $shipping  = Shipping::all();
        return $shipping;
    }



    public function store(ShippingRequest $request)
    {
        $validatedData = $request->validated();
        CleanInputs($validatedData);

        $validatedData['user_id'] = getSimpleUser()->id;
        Shipping::create($validatedData);
        return response()->json(['message' => 'addresse ajoute avec success']);
    }

    public function update(ShippingRequest $request, shipping $shipping)
    {
        $validatedData = $request->validated();
        CleanInputs($validatedData);

        $shipping->update($validatedData);
        return response()->json(['message' => 'shipping addresse updated successfully']);
    }

    public function show($id)
    {
        try {
            $shipping = Shipping::findOrFail($id);
            return response()->json(['addresse'  => $shipping ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'shipping not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $shipping = Shipping::findOrFail($id);
            $shipping->delete();
            return response()->json(['message' => 'shipping deleted successfully']);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'shipping not found'], 404);
        }
    }
}
