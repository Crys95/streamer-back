<?php

namespace App\Http\Controllers\Likes;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Http\Requests\Likes\LikesRequest;
use App\Repositories\Likes\LikesRepository;
use Illuminate\Http\JsonResponse;

class LikesController extends Controller
{

    public function __construct(
        private readonly LikesRepository $likesRepository
    ) {
    }

    public function like(LikesRequest $request): JsonResponse
    {

        try {
            return $this->likesRepository->like($request);
        } catch (\Exception $e) {
            return Utils::exceptionReturn($e);
        }
    }

    public function listLikes(): JsonResponse
    {

        try {
            return $this->likesRepository->listLikes();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
