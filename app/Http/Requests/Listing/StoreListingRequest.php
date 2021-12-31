<?php

namespace App\Http\Requests\Listing;

use Illuminate\Foundation\Http\FormRequest;

class StoreListingRequest extends FormRequest
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
            'address.street1' => ['required', 'string', 'max:255'],
            'address.street2' => ['nullable', 'string', 'max:255'],
            'address.city' => ['nullable', 'string', 'max:255'],
            'address.state' => ['required', 'string', 'max:255'],
            'address.postal_code' => ['required', 'string', 'max:255'],
            'address.country' => ['required', 'string', 'max:255'],
            'price' => ['required', 'alpha_num'],
            'status' => ['required', 'in:Active,Pending,Sold'],
            'date' => ['required', 'date_format:Y-m-d'],
        ];
    }
    
    public function messages()
    {
        return [
            'address.country.required' => "This field is required.",
            'address.street1.required' => "This field is required.",
            'address.postal_code.required' => "This field is required.",
            'address.state.required' => "This field is required.",
        ];
    }
}
