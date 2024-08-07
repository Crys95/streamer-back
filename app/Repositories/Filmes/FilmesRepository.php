<?php

namespace App\Repositories\Filmes;

use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
class FilmesRepository
{
    private $apiKey;
    private $client;
    private $url;
    public function __construct() {
        $this->apiKey = config('services.apiKey.key');
        $this->url = config('services.apiFilmes.url');
        $this->client = new Client();
    }

    public function ListMovie($request)
    {
    
        $queryParams = [
            'api_key' => $this->apiKey,
            'language' => 'pt-BR',
            'page' => $request['pagina'],
            'region' => 'BR',
            'query' => $request['filme'], 
        ];
    
        $response = $this->client->request('GET', "{$this->url}/{$request['tipo']}", [
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

    public function getMovieDetails($movieId)
    {
            $response = $this->client->request('GET', "{$this->url}/movie/{$movieId}", [
                'query' => [
                    'api_key' => $this->apiKey,
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

            $response = $this->client->request('GET', "{$this->url}/movie/{$movieId}/videos", [
                'query' => [
                    'api_key' => $this->apiKey,
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
