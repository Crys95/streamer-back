<?php

namespace App\Http\Controllers\Filmes;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Repositories\Filmes\FilmesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FilmesController extends Controller
{

    public function __construct(
        private FilmesRepository $filmesRepository
    ) {
    }

    public function ListMovie(Request $request): JsonResponse
    {

        try {
            return $this->filmesRepository->ListMovie($request);
        } catch (\Exception $e) {
            return Utils::exceptionReturn($e);
        }
    }

    public function getMovieDetails(Request $request, $movieId): JsonResponse
    {

        try {
            return $this->filmesRepository->getMovieDetails($request, $movieId);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getMovieVideos($movieId): JsonResponse
    {

        try {
            return $this->filmesRepository->getMovieVideos($movieId);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
