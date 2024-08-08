<?php

namespace App\Http\Controllers\Comments;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\CommentsRequest;
use App\Repositories\Comments\CommentsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function __construct(
        private readonly CommentsRepository $commentsRepository
    ) {
    }

    public function create(CommentsRequest $request): JsonResponse
    {
        try {
            return $this->commentsRepository->create($request);
        } catch (\Exception $e) {
            return Utils::exceptionReturn($e);
        }
    }

    public function listComments(Request $request): JsonResponse
    {

        try {
            return $this->commentsRepository->listComments($request);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
