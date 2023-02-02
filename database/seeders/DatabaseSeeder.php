<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        
        
        $user = \App\Models\User::factory()->create([
            'name'=> 'tmax',
            'email'=>'tmax@gmail.com',
            'password'=> bcrypt('tmax123')
        ]);

       

        $role = Role::create(['name' => 'usuario']);
        $role->syncPermissions(Permission::pluck('id','id')->all());
        $user->assignRole([$role->id]);


        $books =  \App\Models\Book::factory(5)->create([
            'user_id' => $user->id
        ]);

        $reservation = \App\Models\Reservation::factory(1)->create([
            'user_id' => $user->id,
            'books_id' => $books[0]->id
        ]);

        
      
       



    }
}
