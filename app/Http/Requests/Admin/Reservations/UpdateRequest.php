<?php

namespace App\Http\Requests\Admin\Reservations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|Int',
            'marasi_id' => 'required|Int',
            'employee_id' => 'required|Int',
            'status' => 'required|in:in progress,rejected,canceled,completed',
        ];
    }

    public function failedValidation(Validator $validator)

    {
        abort(403, 'Unauthorized');
    }
}
