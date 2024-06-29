<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class SellController extends Controller
{

    public function sells(){
        $sells = Sell::with('product')->get()->map(function ($sell){
            $sell->product->image = URL::to($sell->product->image);
            return $sell;
        });
        return response()->json($sells);
    }

    public function filterSellsByDates(Request $request){
        $sells = filterByDates($request,"sell");
   return response()->json($sells,200);
       }
}
