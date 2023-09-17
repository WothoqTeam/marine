<?php

namespace App\Http\Requests\Api\Reservations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PayReservationsRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'payment_method' => 'required|in:cash,apple,credit',
            'sub_total' => 'required',
            'vat' => 'required',
            'service_fee' => 'required',
            'total' => 'required'
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
