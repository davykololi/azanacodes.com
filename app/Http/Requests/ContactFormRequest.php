<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            //Customized Messages
            'name.required' => 'Name required',
            'email.required' => 'Email Address required',
            'subject.required' => 'The subject of your message is required',
            'message.required' => 'The real message is required',
        ];
    }
}
