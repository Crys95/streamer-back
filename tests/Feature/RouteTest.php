<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\Mocks\Middleware\MockBasicMiddleware;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'name' => 'teste teste',
            'email' => 'teste@teste.com',
            'password' => Hash::make('senha0001'),
            'identify' => (string) Str::uuid(),
        ]);

        $this->app->make('router')->aliasMiddleware(
            'auth',
            MockBasicMiddleware::class,
        );
    }

    // login e register
    public function test_register()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', 'api/auth/register', [
            'name' => 'teste teste',
            'email' => 'testes@testes.com',
            'password' => 'senha0001',
        ]);

        $response->assertStatus(201);
    }

    public function test_login()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', 'api/auth/login', [
            'email' => $this->user->email,
            'password' => 'senha0001',
        ]);

        $response->assertStatus(200);
    }

    // filmes
    public function test_movie_details()
    {
        $this->actingAs($this->user);

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('GET', 'api/movie/15');
        $response->assertStatus(200);
    }

    public function test_movie_video()
    {
        $this->actingAs($this->user);

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('GET', 'api/movie/video/15');
        $response->assertStatus(200);
    }

    // curtidas de filmes
    public function test_create_like()
    {
        $this->actingAs($this->user);

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', 'api/commit/create', [
            "movie_id" => 1,
            "comment" => "car",
            'name' => 'avatar',
            'date' => now(),
        ]);

        $response->assertStatus(201);
    }


    public function test_list_like()
    {
        $this->actingAs($this->user);

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('GET', 'api/like/list');
        $response->assertStatus(200);
    }

    public function test_get_by_like()
    {
        $this->actingAs($this->user);

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('GET', 'api/like/list', [
            "movie_id" => 1,
        ]);
        $response->assertStatus(200);
    }

    // comentario de filme
    public function test_create_commit()
    {
        $this->actingAs($this->user);

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', 'api/like/create', [
            "movie_id" => 1,
            "assessment" => "homes grande e azul",
            'title' => 'avatar',
            'img' => 'image/image',
            'favorite' => 1,
        ]);

        $response->assertStatus(201);
    }

    public function test_list_commit()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('GET', 'api/commit/list');
        $response->assertStatus(200);
    }
}
