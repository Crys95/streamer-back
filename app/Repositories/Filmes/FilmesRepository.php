<?php

namespace App\Repositories\Filmes;

use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
class FilmesRepository
{
    private $apiKey;
    private $client;
    public function __construct() {
        $this->apiKey = config('services.apiKey.key');
        $this->client = new Client();
    }

    public function ListMovie($request)
    {
        $client = $this->client;
        $apiKey = $this->apiKey;

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
    }

    public function getMovieDetails($request, $movieId)
    {
        $client = $this->client;
        $apiKey = $this->apiKey;

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
    }

    public function getMovieVideos($movieId): JsonResponse
    {
        $client = $this->client;
        $apiKey = $this->apiKey;
    
            $response = $client->request('GET', "https://api.themoviedb.org/3/movie/{$movieId}/videos", [
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
                'videos' => $body['results'],
            ]);
    }
}
