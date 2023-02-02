<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        // Let's get the route param by name to get the User object value
        $user = request()->route('user');

        return [
            'name'=>['required', 'min:3'],
            'email' => 'required|email:rfc,dns|unique:users,email,'.$user->id,
            'password'=>['required', 'confirmed', 'min:6'],
        ];
    }

    public function messages(){

        return ['name.required'=>'Favor inserir nome.', 
            'email.required'=>'Favor inserir email.',
            'password.required'=> 'Favor inserir senha.',
            'password.confirmed' => 'Favor confirmar senha.',
            'password.min:6' => 'A senha deve ter pelo menos 6 caracteres.',
            'email.unique'=>'Email já existe.',
        
        ];
    }
}
