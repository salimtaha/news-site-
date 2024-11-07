<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required' , 'min:2' , 'max:60'],
            'username'=>['required' , 'unique:users,username,'.auth()->user()->id],
            'email'=>['required' , 'email', Rule::unique('users' , 'email')->ignore(auth()->user()->id)],
            'phone'=>['required' , 'numeric', Rule::unique('users' , 'phone')->ignore(auth()->user()->id) ],
            'country'=>['required' , 'min:2' , 'max:20'],
            'city'=>['required' , 'min:2' , 'max:20'],
            'street'=>['required' , 'min:2' , 'max:30'],
            'image'=>['nullable',  'mimes:png,jpg' , 'image'],
        ];
    }
}
