<?php

namespace App\Repositories\Comments;

use App\Models\Comments;
use App\Services\DefaultPaginateService;

class CommentsRepository
{
    public function __construct(
        private readonly Comments $CommentsModel,
        private readonly DefaultPaginateService $DefaultPaginateService,
    ) {
    }

    public function create($request)
    {
        $identify = auth()->user()->identify;
        $name = auth()->user()->name;
        $this->CommentsModel->create([
            'user_id' => $identify,
            'movie_id' => $request['movie_id'],
            'name' => $name,
            'date' => now(),
            'comment' => $request['comment'],
        ]);

        return response()->json('success create', 201);
    }

    public function listComments($request)
    {
        $listComments = $this->CommentsModel->where('movie_id', $request['movie_id'])->get();

        $response = [
            "data" => $listComments
        ];

        return response()->json($response);
    }
}
