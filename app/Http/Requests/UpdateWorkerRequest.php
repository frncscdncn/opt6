<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkerRequest extends FormRequest
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
            'company_id' => 'required|exists:companies,id',
            'phone_number' => 'required|regex:/^\+7-\d{3}-\d{3}-\d{2}-\d{2}$/i',
            'image' => 'mimes:jpeg,png,jpg|max:5000',
        ];
    }
}
