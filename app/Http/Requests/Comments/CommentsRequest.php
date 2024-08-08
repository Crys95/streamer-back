<?php

namespace App\Http\Requests\Comments;

use App\Http\Requests\NoRedirect;
use Illuminate\Foundation\Http\FormRequest;

class CommentsRequest extends FormRequest
{

    use NoRedirect;

    public function rules(): array
    {
        return [
            'movie_id' => ['required', 'integer'],
            'comment' => ['required', 'string', 'max:255']
        ];
    }

}
