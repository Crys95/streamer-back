<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Likes extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'likes';

    protected $fillable = [
        'user_id',
        'movie_id',
        'title',
        'assessment',
        'img',
        'favorite',
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
    ];

}
