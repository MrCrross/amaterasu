<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceUpdateRequest extends FormRequest
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
            'img'=>'nullable|image|mimes:jpg,png,jpeg,gif',
            'name'=>'required|string|max:255',
            'price'=>'required|integer|min:1',
            'service_type_id'=>'required|numeric|min:1',
            'description'=>'required|required|string',
            'indications'=>'array',
            'indications.*'=>'nullable|numeric|min:1',
            'contraindications'=>'array',
            'contraindications.*'=>'nullable|numeric|min:1',
            'workers'=>'array',
            'workers.*'=>'nullable|numeric|min:1',
        ];
    }
}
