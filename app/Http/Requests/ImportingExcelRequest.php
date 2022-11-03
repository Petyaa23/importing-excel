<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportingExcelRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'file' => 'required|mimes:xlsx'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'File is required!',
            'file.mimes' => 'Please upload only xlsx! Excel file!',
        ];
    }
}