<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
     /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('users.create', ['roles'=>Role::all()]);
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param StoreUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request) 
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $formFields = $request->validate([
            'name'=>['required', 'min:3'],
            'email'=>['required', 'email', Rule::unique('users','email')],
            'password'=>['required', 'confirmed', 'min:6'],
            ]
        );
        $user->create($formFields)->syncRoles($request->get('role'));
        

        return redirect()->route('users.index')
            ->with('message','Usuário adicionado com sucesso.');
    }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) 
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) 
    {
        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request) 
    {   
        $formFields = $request->validate([
            'name'=>['required', 'min:3'],
            'email'=>['required', 'email', Rule::unique('users','email')],
            'password'=>['required', 'confirmed', 'min:6'],
        ]
        );
        $formFields['password'] = bcrypt($formFields['password']);
        $user->update($formFields);

        $user->syncRoles($request->get('role'));

        return redirect()->route('users.index')
            ->with('message','Usuário atualizado com sucesso.');
    }

    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) 
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('message','Usuário deletado com sucesso.');
    }
}
