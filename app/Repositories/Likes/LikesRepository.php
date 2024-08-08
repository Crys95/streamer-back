<?php

namespace App\Repositories\Likes;

use App\Models\Likes;
use App\Services\DefaultPaginateService;

class LikesRepository
{
    public function __construct(
        private readonly Likes $likeModel,
        private readonly DefaultPaginateService $DefaultPaginateService,
    ) {
    }

    public function like($request)
    {
        $identify = auth()->user()->identify;
        $movieId = $request['movie_id'];

        $existingLike = $this->likeModel
            ->where('user_id', $identify)
            ->where('movie_id', $movieId)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            return response()->json('Remove favorites', 200);
        } else {
            $this->likeModel->create([
                'user_id' => $identify,
                'movie_id' => $movieId,
                'title' => $request['title'],
                'assessment' => $request['assessment'],
                'img' => $request['img'],
                'favorite' => $request['favorite'],
            ]);

            return response()->json('add favorites', 201);
        }
    }

    public function Getlike($request)
    {
        $identify = auth()->user()->identify;
        $movieId = $request['movie_id'];

        $existingLike = $this->likeModel
            ->where('user_id', $identify)
            ->where('movie_id', $movieId)
            ->exists();

            return response()->json($existingLike);
    }

    public function listLikes()
    {
        $identify = auth()->user()->identify;
        $likes = $this->likeModel
            ->where('user_id', $identify)
            ->get();

        $response = [
            "data" => $likes
        ];

        return response()->json($response);
    }
}
