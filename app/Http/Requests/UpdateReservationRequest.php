<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id'=>['required'],
            'books_id'=>['required'],
        ];
    }

    public function messages()
    {
        return [
            'user_id.required'=>'Favor selecionar usuário.',
            'books_id.required'=>'Favor selecionar livro.',
        ];
    }
}
