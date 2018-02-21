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
    public function showDeletedFriends(){
        $friendsObject =Facebook::select('full_name')->get();
        $friendsList = $friendsObject->toArray();
        $deletedFriends = [];
        for($i = 0; $i < count($request->allFreindsList); $i++){
            if(in_array($request->allFreindsList[$i], $friendsList){
                array_push($deletedFriends, $request->allFreindsList[$i]);
            }
        }
        return response()->json([
            $deletedFriends
        ]);

    }
}
