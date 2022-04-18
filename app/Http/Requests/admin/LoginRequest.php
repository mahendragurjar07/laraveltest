<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|regex:'. config('constants.Regex.EMAIL'),
            'password' => 'required'
        ];
    }

    /**
     * admin login validation messages
     */
    public function messages()
    {
        return [
            'email.required' => 'Please enter an email address.',
            'email.regex' => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
        ];
    }
}
