<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
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
        $user->assignRole('Usuario');
        auth()->login($user);
        return redirect('/')->with('message', 'Usuário cadastrado e logado.');
    }

    public function logout(){
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/')->with('message', 'Sessão Encerrada com sucesso.');
    }

    public function login(){
        
        return view('users.login');
    }

    public function authenticate(){
        $formFields = request()->validate([
           
            'email'=>['required', 'email'],
            'password'=>'required',
            // 'password_confirmation'=>'required',
        ],
        ['name.required'=>'Favor inserir nome.', 
        'email.required'=>'Favor inserir email.',
        'password.required'=> 'Favor inserir senha.',
    
        ]);

        if (auth()->attempt($formFields)){
            request()->session()->regenerate();
            return redirect('/')->with('message','Logado com sucesso.');
        }
        return back()->withErrors([ 'email'=>'Credenciais Inválidas' ])->onlyInput('email');
    }
}
