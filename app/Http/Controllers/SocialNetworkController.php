<?php

namespace App\Http\Controllers;

use App\Facebook;
use App\Instagram;
use Illuminate\Http\Request;

class SocialNetworkController extends Controller
{
    /** Rows per INSERT query, keeps us well under MySQL placeholder/packet limits. */
    private const INSERT_CHUNK = 500;

    private const MODELS = [
        'facebook'  => Facebook::class,
        'instagram' => Instagram::class,
    ];

    public function createFriends(Request $request, string $network)
    {
        $model = self::MODELS[$network];

        $rows = array_map(
            fn ($name) => ['full_name' => $name],
            $this->friendsFromRequest($request)
        );

        $model::truncate();
        foreach (array_chunk($rows, self::INSERT_CHUNK) as $chunk) {
            $model::insert($chunk);
        }

        return response()->json(['Success']);
    }

    public function showDeletedFriends(Request $request, string $network)
    {
        $model = self::MODELS[$network];

        $savedFriends = $model::pluck('full_name')->all();
        $currentFriends = array_flip($this->friendsFromRequest($request));

        // Hash lookup: O(n + m) instead of in_array's O(n * m).
        $deletedFriends = array_values(array_filter(
            $savedFriends,
            fn ($name) => !isset($currentFriends[trim($name)])
        ));

        return response()->json($deletedFriends);
    }

    /**
     * @return string[] non-empty, trimmed friend names
     */
    private function friendsFromRequest(Request $request): array
    {
        $list = (array) $request->input('allFreindsList', []);

        return array_values(array_filter(
            array_map(fn ($name) => trim((string) $name), $list),
            fn ($name) => $name !== ''
        ));
    }
}
