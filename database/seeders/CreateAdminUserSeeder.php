<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin', 
            'email' => 'admin@gmail.com',
           
            'password' => bcrypt('admin123'),
        ]);
    
        $role = Role::create(['name' => 'admin']);
        $role->syncPermissions(Permission::pluck('id','id')->all());
        $user->assignRole([$role->id]);
    }
}
