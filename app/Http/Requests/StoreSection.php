<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSection extends FormRequest
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
            'Name_Section_Ar'=>'required' ,
            'Name_Section_En'=>'required' ,

//            'List_Classes.*.Name' => 'required',
//            'List_Classes.*.Name_class_en' => 'required',
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
            'Name_Section_Ar'=>trans('validation.required'),
            'Name_Section_En'=>trans('validation.required'),
//            'List_Classes.*.Name.required'=>trans('validation.required'),
//            'List_Classes.*.Name_class_en.required' => trans('validation.required'),
        ];
    }
}
