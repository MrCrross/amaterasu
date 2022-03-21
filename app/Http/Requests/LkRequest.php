<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LkRequest extends FormRequest
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
            'last_name'=>'nullable|string|max:255',
            'first_name'=>'nullable|string|max:255',
            'birthday'=>'nullable|date',
            'avatar'=>'nullable|image|mimes:jpg,png,jpeg,gif,svg',
            'name'=>'nullable|string|max:255',
            'password'=>'nullable|string|max:255|same:password_confirmation',
            'phone'=>'nullable|string|max:16|min:16'
        ];
    }
}
