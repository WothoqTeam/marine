<?php

namespace App\Http\Requests\Api\Rate;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ListRateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'required|in:User,Yachts,Employee',
            'type_id' => 'required|Int',
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
