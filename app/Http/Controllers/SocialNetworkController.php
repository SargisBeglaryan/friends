<?php

namespace App\Http\Controllers;
use App\Facebook as Facebook;
use App\Instagram as Instagram;

use Illuminate\Http\Request;

class SocialNetworkController extends Controller
{
    public function createFacebookFriends(Request $request){
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

    public function showFacebookDeletedFriends(Request $request){
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

    public function createInstagramFriends(Request $request){
        $arrayList = [];
        for($i = 0; $i < count($request->allFreindsList); $i++){
            if($request->allFreindsList[$i] != '') {
                array_push($arrayList, ['full_name'=> $request->allFreindsList[$i]]);
            }
        }
        
        Instagram::truncate();
        Instagram::insert($arrayList);
        return response()->json([
            'Success'
        ]);
    }

    public function showInstagramDeletedFriends(Request $request){
        $friendsList =Instagram::select('full_name')->pluck('full_name')->toArray();
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
