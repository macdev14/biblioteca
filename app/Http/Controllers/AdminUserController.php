<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function create(){
        return view('users.register');
    }

    public function store(){
        $formFields = request()->validate([
            'name'=>['required', 'min:3'],
            'email'=>['required', 'email', Rule::unique('users','email')],
            'password'=>['required', 'confirmed', 'min:6'],
            // 'password_confirmation'=>'required',
        ],
        ['name.required'=>'Favor inserir nome.', 
        'email.required'=>'Favor inserir email.',
        'password.required'=> 'Favor inserir senha.',
        'password.confirmed' => 'Favor confirmar senha.',
        'password.min:6' => 'A senha deve ter pelo menos 6 caracteres.',
        // 'password_confirmation.required'=> 'Favor confirmar senha'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);
        $user->assignRole('Admin');
        auth()->login($user);
        return redirect('/')->with('message', 'Usuário cadastrado e logado.');
    }
}
