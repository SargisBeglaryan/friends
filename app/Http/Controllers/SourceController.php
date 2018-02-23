<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Source as Source;

class SourceController extends Controller
{
    public function index()
    {
    	$source = Source::select('source')->orderBy('id', 'desc')->first();
    	return view('welcome')->with('source', $source);
    }

    public function createSource(Request $request)
	{
		Source::insert(['source' => $request->source]);
    	return response()->json([
		    'Success'
		]);
	}
}
