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
        $book = Permission:: where('name', 'like','%'.'book'.'%')->get();
        $reservation = Permission:: where('name', 'like','%'.'reservation'.'%')->where('name','!=','reservation.manage')->where('name','!=','reservation.edit')->where('name','!=','reservation.update')->get();
        $index =Permission::where('name','=','user-authenticate')->orWhere('name','=','logout')->orWhere('name','=','index')->orWhere('name','=','sanctum.csrf-cookie')->get();
        $permissions = $book->merge($reservation);
        $permissions= $permissions->merge($index);
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);


        $books =  \App\Models\Book::factory(5)->create([
            'user_id' => $user->id,
            'title' => 'Livro teste',
            'image'=>'https://m.media-amazon.com/images/I/41HyIy0wgrL.jpg'
        ]);

        $reservation = \App\Models\Reservation::factory(1)->create([
            'user_id' => $user->id,
            'books_id' => $books[0]->id
        ]);

        
      
       



    }
}
