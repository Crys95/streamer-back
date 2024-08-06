<?php

namespace App\Http\Controllers\Acao;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;;
use App\Repositories\Auth\AuthRepository;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class AcaoController extends Controller
{

    public function __construct(
        private readonly AuthRepository $authRepository
    ) {
    }

    public function ListMovie(Request $request): JsonResponse
    {
        $client = new Client();
        $apiKey = '59ddf547b167b9c783671e8c94c5673e';
    
        try {
            $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/popular', [
                'query' => [
                    'api_key' => $apiKey,
                    'language' => 'pt-BR',
                    'page' => 1,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);
    
            $body = json_decode($response->getBody()->getContents(), true);
    
            return response()->json([
                'status' => $response->getStatusCode(),
                'data' => $body['results'] ?? [],
            ]);
        } catch (\Exception $e) {
            return Utils::exceptionReturn($e);
        }
    }

    public function getMovieDetails(Request $request, $movieId): JsonResponse
    {
        $client = new Client();
        $apiKey = '59ddf547b167b9c783671e8c94c5673e';
    
        try {
            $response = $client->request('GET', "https://api.themoviedb.org/3/movie/{$movieId}", [
                'query' => [
                    'api_key' => $apiKey,
                    'language' => 'pt-BR',
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);
    
            $body = json_decode($response->getBody()->getContents(), true);
    
            return response()->json([
                'status' => $response->getStatusCode(),
                'data' => $body,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    
}
