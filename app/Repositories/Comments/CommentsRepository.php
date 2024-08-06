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

        $this->CommentsModel->create([
            'user_id' => $identify,
            'movie_id' => $request['movie_id'],
            'name' => $request['name'],
            'date' => now(),
            'comment' => $request['comment'],
        ]);

        return response()->json('success create', 201);
    }

    public function listComments()
    {
        $listComments = $this->CommentsModel
            ->paginate(10);
        $response = $this->DefaultPaginateService->DefaultPaginate($listComments, $listComments->items());

        return response()->json($response);
    }
}
