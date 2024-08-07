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
    
    
        $queryParams = [
            'api_key' => $apiKey,
            'language' => 'pt-BR',
            'page' => $request['pagina'],
            'region' => 'BR',
            'query' => $request['filme'], 
        ];
    
        $response = $client->request('GET', "https://api.themoviedb.org/3/{$request['tipo']}", [
            'query' => $queryParams,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
    
        $body = json_decode($response->getBody()->getContents(), true);
    
        $limitedResults = array_slice($body['results'], 0, 12);
    
        return response()->json([
            'status' => $response->getStatusCode(),
            'data' => $limitedResults,
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
