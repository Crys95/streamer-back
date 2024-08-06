<?php

namespace App\Http\Requests\Likes;

use App\Http\Requests\NoRedirect;
use Illuminate\Foundation\Http\FormRequest;

class LikesRequest extends FormRequest
{

    use NoRedirect;

    public function rules(): array
    {
        return [
            'movie_id' => ['required', 'integer'],
            'title' => ['required', 'string'],
            'assessment' => ['required', 'string'],
            'img' => ['required', 'string', 'max:255'],
            'favorite' => ['required', 'boolean']
        ];
    }

}
