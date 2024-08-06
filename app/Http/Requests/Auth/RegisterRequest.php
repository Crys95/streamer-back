<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\NoRedirect;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    use NoRedirect;


    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

}
