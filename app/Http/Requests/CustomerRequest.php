<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

/**
 * Class CustomerRequest
 * @package App\Http\Requests
 */
class CustomerRequest extends FormRequest
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
            'country' => ['sometimes', 'string', Rule::in(array_keys(config('country_code_regex')))],
            'state'   => ['sometimes', 'boolean'],
        ];
    }

    /**
     * @param \Illuminate\Contracts\Validation\Validator $validator
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        if ($validator->fails()) {
            throw new HttpResponseException(response()->json($validator->errors()->all(), 422));
        }
    }
}
