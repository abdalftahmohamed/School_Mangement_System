<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroom extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //علشان اسمح اني ادخل الصفحة دي
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
            'List_Classes.*.Name' => 'required',

            'List_Classes.*.Name_class_en' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    //ده معمول علشان الترجمة للصفحة
    public function messages()
    {
        return [
            'List_Classes.*.Name.required'=>trans('validation.required'),
            'List_Classes.*.Name_class_en.required' => trans('validation.required'),
        ];
    }
}
