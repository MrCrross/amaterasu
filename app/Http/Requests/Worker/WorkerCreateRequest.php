<?php

namespace App\Http\Requests\Worker;

use Illuminate\Foundation\Http\FormRequest;

class WorkerCreateRequest extends FormRequest
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
            'name'=>'required|string|max:255',
            'password' => 'required|same:password_confirmation',
            'roles' => 'required',
            'img'=>'required|image|mimes:jpg,png,jpeg,gif',
            'last_name'=>'required|string|max:255',
            'first_name'=>'required|string|max:255',
            'birthday'=>'required|date',
            'description'=>'required|string',
            'post_id'=>'required|numeric',
            'services' => 'array',
            'services.*'=>'nullable|numeric',
        ];
    }
}
