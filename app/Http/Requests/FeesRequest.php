<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeesRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'decimal:0,2'],
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
            'year' => 'required',
            'notes' => 'string',
            'fee_type' => 'required|numeric'


        ];
    }
}
