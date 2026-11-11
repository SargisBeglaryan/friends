<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Source as Source;

class SourceController extends Controller
{
    public function index()
    {
    	$source = Source::latest('id')->value('source');
    	return view('welcome')->with('source', $source);
    }

    public function createSource(Request $request)
	{
		// Only the latest source is ever read, so keep a single row instead of
		// accumulating full page HTML on every save.
		DB::transaction(function () use ($request) {
			Source::query()->delete();
			Source::insert(['source' => (string) $request->input('source', '')]);
		});

    	return response()->json([
		    'Success'
		]);
	}
}
