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
        $cacheKey = 'sells';
        $cacheData = getCachedData($cacheKey, function () {
        $sells = Sell::with('product')->get()->map(function ($sell){
            $sell->product->image = URL::to($sell->product->image);
            return $sell;
        });
        return $sells;
    });
    return response()->json($cacheData);
    }

    public function filterSellsByDates(Request $request){
        $sells = filterByDates($request,"sell");
   return response()->json($sells,200);
       }
}
