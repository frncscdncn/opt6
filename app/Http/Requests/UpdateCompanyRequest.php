<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:100',
            'address' => 'required|string|min:3|max:250',
            'about_company' => 'nullable|string|min:3|max:250',
            'logo' => 'mimes:jpeg,png,jpg|dimensions:min_width=100,min_height=100|max:5000',
        ];
    }
}
