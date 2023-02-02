<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'=>['required', 'min:3'],
            'email'=>['required', 'email', Rule::unique('users','email')],
            'password'=>['required', 'confirmed', 'min:6'],
        ];
    }

    public function messages(){
        return   ['name.required'=>'Favor inserir nome.', 
        'email.required'=>'Favor inserir email.',
        'password.required'=> 'Favor inserir senha.',
        'password.confirmed' => 'Favor confirmar senha.',
        'password.min:6' => 'A senha deve ter pelo menos 6 caracteres.',
        // 'password_confirmation.required'=> 'Favor confirmar senha'
    ];
    }
}
