<?php

namespace App\Http\Requests\Api\Reservations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreReservationsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'yacht_id' => 'required|Int',
            'start_day' => 'required|date',
            'end_day' => 'required|date',
            'note' => 'nullable|string',
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
