<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait NoRedirect
{
    public function authorize(): bool
    {
        return true;
    }
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Alguns parametros foram enviados incorretamente. Por favor, verifique e tente novamente.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
