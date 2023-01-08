<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrades extends FormRequest
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
//            .$this->id ده علشان لما يعمل update علي نفس الاسم مايجبش error
            'Name' => 'required|unique:grades,name->ar,'.$this->id,
            'Name_en' => 'required|unique:grades,name->en,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'Name.required' => trans('validation.required'),
            'Name.unique' => trans('validation.unique'),
            'Name_en.required' => trans('validation.required'),
            'Name_en.unique' => trans('validation.unique'),
        ];
    }
}
