<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptStudentRequest extends FormRequest
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
            'Debit' => 'required|integer',
            'description' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'Debit.required' => trans('validation.required'),
            'description.required' => trans('validation.unique'),
            'description.string' => trans('validation.string'),
            'Debit.integer' => trans('validation.integer'),

        ];
    }
}
