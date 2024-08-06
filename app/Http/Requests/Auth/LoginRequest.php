<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\NoRedirect;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    use NoRedirect;

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ];
    }

}
