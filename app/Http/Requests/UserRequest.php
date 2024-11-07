<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>['required' , 'string' , 'min:2'],
            'username'=>['required' , 'unique:users,username'],
            'email'=>['required' , 'unique:users,email'],
            'phone'=>['required' , 'unique:users,phone'],
            'status'=>['in:0,1'],
            'email_verified_at'=>['in:0,1'],
            'country'=>['required', 'string' , 'min:2' , 'max:10'],
            'city'=>['required', 'string' , 'min:2' , 'max:30'],
            'street'=>['required', 'string' , 'min:2' , 'max:30'],
            'password'=>['required' , 'confirmed'],
            'password_confirmation'=>['required'],
            'image'=>['required'],

        ];
    }
}
