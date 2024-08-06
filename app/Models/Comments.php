<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Comments extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'movie_id',
        'name',
        'date',
        'comment',
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
    ];

}
