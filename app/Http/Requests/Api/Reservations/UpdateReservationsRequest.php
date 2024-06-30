<?php

namespace App\Http\Requests\Api\Reservations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateReservationsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'times'=>'required',
            'times.*' => 'required|int|exists:yachts_prices,id',
            'note' => 'nullable|string',
            'num_guests' => 'nullable|int',
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
