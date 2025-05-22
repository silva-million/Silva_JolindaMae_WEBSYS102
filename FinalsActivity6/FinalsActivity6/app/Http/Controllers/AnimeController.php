<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class AnimeController extends Controller
{
    public function search($title)
    {
        $response = Http::get("https://api.jikan.moe/v4/anime", [
            'q' => $title,
            'limit' => 1,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (!empty($data['data'])) {
                $anime = $data['data'][0];
                return response()->json([
                    'status' => 'success',
                    'data' => [
                        'title' => $anime['title'],
                        'synopsis' => $anime['synopsis'],
                        'score' => $anime['score'],
                        'episodes' => $anime['episodes'],
                        'image' => $anime['images']['jpg']['image_url'] ?? null,
                    ],
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No anime found.',
                ], 404);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to fetch anime data.',
        ], 500);
    }
}
