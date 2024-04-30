<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends FormRequest
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
            'company_vat' => [
                'nullable',
                'string',
                'max:50',
            ],

            'address_street' => [
                'nullable',
                'string',
                'max:50',
            ],
            'address_number' => [
                'nullable',
                'string',
                'max:20',
            ],
            'address_country' => [
                'nullable',
                'string',
                'max:2',
            ],
            'address_postal_code' => [
                'nullable',
                'string',
                'max:10',
            ],
            'address_place' => [
                'nullable',
                'string',
                'max:100',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'email' => [
                'nullable',
                'string',
                'max:191',
                'email',
                Rule::unique('customers', 'email')->whereNull('deleted_at')->ignore($this->customer),
            ],

            'delivery_address_street' => [
                'nullable',
                'string',
                'max:50',
            ],
            'delivery_address_number' => [
                'nullable',
                'string',
                'max:20',
            ],
            'delivery_address_country' => [
                'nullable',
                'string',
                'max:2',
            ],
            'delivery_address_postal_code' => [
                'nullable',
                'string',
                'max:10',
            ],
            'delivery_address_place' => [
                'nullable',
                'string',
                'max:100',
            ],
        ];
    }
}
