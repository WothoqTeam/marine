<?php

namespace App\Http\Requests\Api\Yachts;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateYachtsRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_en'=>'required|string',
            'name_ar'=>'required|string',
            'description_en'=>'required|string',
            'description_ar'=>'required|string',
            'add_info_en'=>'required|string',
            'add_info_ar'=>'required|string',
            'booking_info_en'=>'required|string',
            'booking_info_ar'=>'required|string',
            'address_en'=>'nullable|string',
            'address_ar'=>'nullable|string',
            'price'=>'required|numeric',
            'is_discount'=>'nullable|boolean',
            'discount_value'=>'required|numeric',
            'country_id' => 'required|int|exists:countries,id',
            'city_id' => 'required|int|exists:cities,id',
            'longitude'=>'nullable|string',
            'latitude'=>'nullable|string',
            'images'=>'nullable',
            'images.*' => 'nullable|mimes:jpg,jpeg,png,bmp|max:20000'
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
