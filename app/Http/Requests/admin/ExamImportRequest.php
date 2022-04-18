<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ExamImportRequest extends FormRequest
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
            'file' => 'mimes:xlsx|required|max:5000'
        ];
    }

    /**
     * admin login validation messages
     */
    public function messages()
    {
        return [
            'file.mimes'=> 'Please add xlsx file not exceeding 5Mbs',
            'file.image'=> 'Please add xlsx file not exceeding 5Mbs',
            'file.max'=> 'Please add xlsx file not exceeding 5Mbs',
            'file.required'=> 'Please add xlsx file not exceeding 5Mbs',
        ];
    }
}
