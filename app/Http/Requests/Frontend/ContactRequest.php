<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name'=>['required' , 'string' , 'min:2' , 'max:50'],
            'email'=>['required' , 'email'],
            'title'=>['required' , 'string' , 'max:60'],
            'body'=>['required' , 'min:10' , 'max:500'],
            'phone'=>['numeric' , 'required'],
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        if(request()->expectsJson()){
            throw new HttpResponseException(apiResponse(422 , 'errors' , ['errors'=>$validator->errors()]));
        }

        parent::failedValidation($validator);

    }
}
