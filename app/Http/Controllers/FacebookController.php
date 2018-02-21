<?php

namespace App\Http\Controllers;
use App\Facebook as Facebook;

use Illuminate\Http\Request;

class FacebookController extends Controller
{
    public function createFriends(Request $request){

    	for($i = 0; $i < count($request->allFreindsList); $i++){
    		Facebook::insert(['full_name' => $request->allFreindsList[$i]]);
    	}
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
