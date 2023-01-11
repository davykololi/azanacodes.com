<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
            //
            'name' => 'required|string',
            'description' => 'required|string',
            'keywords' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            //Customized Messages
            'name.required' => 'The name of the category is required',
            'description.required' => 'The description of the category is required',
            'keywords.required' => 'The keywords related to the category are required',
        ];
    }
}
