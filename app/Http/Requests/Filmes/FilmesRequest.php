<?php

namespace App\Http\Requests\Filmes;

use App\Http\Requests\NoRedirect;
use Illuminate\Foundation\Http\FormRequest;

class FilmesRequest extends FormRequest
{

    use NoRedirect;

    public function rules(): array
    {
        return [
            'filme' => ['string'],
            'tipo' => ['string'],
            'pagina' => ['integer'],
        ];
    }

}
