<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    //
    public function create(){
        return view('users.register');
    }

    public function store(StoreUserRequest $request){
        $formFields = $request->validated();

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);
        $user->assignRole('usuario');
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
