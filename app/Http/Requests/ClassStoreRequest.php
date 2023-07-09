<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'List_Classes.*.Name' => 'required|unique:classrooms,Name_class->ar' . $this->id,
            'List_Classes.*.Name_class_en' => 'required|unique:classrooms,Name_class->en' . $this->id

        ];
    }


    public function messages()
    {
        return [
            'List_Classes.*.Name.required' => trans('validation.required'),
            'List_Classes.*.Name.unique' => trans('validation.unique'),
            'List_Classes.*.Name_class_en.required' => trans('validation.required'),
            'List_Classes.*.Name_class_en.unique' => trans('validation.unique'),
        ];
    }


}
