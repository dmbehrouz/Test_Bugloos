<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'serviceNames' => ['regex:/^[A-Za-z0-9\s\-\_\@\#\&]+$/'],
            'statusCode' => ['bail', 'numeric', 'digits:3', 'between:100,599'],
            'startDate' => ['date_format:Y-m-d H:i:s'],
            'endDate' => ['date_format:Y-m-d H:i:s'],
        ];
    }

    public function messages()
    {
        return [
            'serviceNames.regex' => 'The field must only contain alphabetic characters, numbers, and certain symbols.',
            'statusCode.between' => 'The statusCode must 3 digits and between 100 to 599!',
            'statusCode' => 'The statusCode must 3 digits and between 100 to 599!',
            'startDate.date_format' => 'The startDate field must like this pattern 2022-02-12 12:20:13',
            'endDate.date_format' => 'The endDate field must like this pattern 2022-02-12 12:50:13',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }


}
