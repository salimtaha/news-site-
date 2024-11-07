<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        $admin_id = $this->route('admin');
        $rules = [
            'name'=>['required' , 'min:2' , 'max:60'],
            'username'=>['required' , 'min:6' , 'max:100' , 'unique:admins,username,'.$admin_id],
            'email'=>['required' , 'email' , 'unique:admins,email,'.$admin_id],
            'status'=>['required' , 'in:0,1'],
            'role_id'=>['required', 'exists:authorizations,id'],
        ];

        if(in_array($this->method() , ['PUT' , 'PATCH'])){
            $rules['password']              =['nullable' , 'confirmed' , 'min:8' , 'max:100'];
            $rules['password_confirmation'] =['nullable'];
        }else{
            $rules['password']=['required' , 'confirmed' , 'min:8' , 'max:100'];
            $rules['password_confirmation']=['required'];
        }
        return $rules;
    }
}
