<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'customer_last_name' => [
                'nullable',
                'string',
                'max:50',
                'required_without_all:customer_first_name,company_name',
            ],
            'customer_first_name' => [
                'nullable',
                'string',
                'max:50',
                'required_without_all:customer_last_name,company_name',
            ],
            'company_name' => [
                'nullable',
                'string',
                'max:50',
                'required_without_all:customer_last_name,customer_first_name',
            ],
            'email' => [
                'nullable',
                'string',
                'max:191',
                'email',
                'unique:customers',
            ],
        ];
    }
}
