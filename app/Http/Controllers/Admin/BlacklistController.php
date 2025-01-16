<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Models\Blacklist;
use App\Models\User;
use Illuminate\Http\Request;

class BlacklistController extends Controller
{
    public function index()
    {
        $cacheKey = 'blacklists';
        $cacheData = getCachedData($cacheKey, function () {
        $blacklists = Blacklist::with('user')->latest()->get();
        return $blacklists;
        });
        clearDashboard();

        return response()->json($cacheData);

    }


    public function store(Request $request)
    {
        $validatedData = $request->validate(['user_id' => 'numeric|required', 'reason' => 'string|required']);
        CleanInputs($validatedData);
        $user= User::find($validatedData['user_id']);
        $validatedData['name'] = $user->name ;
        $user->status = 'blocked';
        $user->save();
        $blacklist = Blacklist::create($validatedData);
        Redis::del('blacklists');
          Redis::del('users');
        return $blacklist ? response()->json(['message' => 'Added to blacklist successfully'],200)
            : response()->json(['message' => 'Oops something went wrong'],402);
    }

    public function destroy($id){
        $blacklist = Blacklist::findOrFail($id) ;
        $user = User::find($blacklist->user_id);
        $user->status = 'active';
        $user->save();
        $blacklist->delete();
        Redis::del('blacklists');
                Redis::del('users');

        return
        response()->json(['message' => 'User has been deblocked successfully']);
    }
}
