<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)

    {
        throw new HttpResponseException(
            response()->json([
                'success'   => false,
                'message'   => 'Invalid data',
                'data'      => $validator->errors()
            ],400)
        );
    }
}
