<?php

namespace App\Http\Controllers;
use App\Facebook as Facebook;

use Illuminate\Http\Request;

class FacebookController extends Controller
{
    public function createFriends(Request $request){
        $arrayList = [];
    	for($i = 0; $i < count($request->allFreindsList); $i++){
    		array_push($arrayList, ['full_name'=> $request->allFreindsList[$i]]);
    	}
        Facebook::truncate();
        Facebook::insert($arrayList);
    	return response()->json([
		    'Success'
		]);
    }
    public function showDeletedFriends(Request $request){
        $friendsList =Facebook::select('full_name')->pluck('full_name')->toArray();
        $deletedFriends = [];
        for($i = 0; $i < count($friendsList); $i++){
            if(!in_array($friendsList[$i], $request->allFreindsList)){
                array_push($deletedFriends, $friendsList[$i]);
            }
        }
        return response()->json([
            $deletedFriends
        ]);

    }
}
