<?php

use App\Entry;
use App\User;
use Illuminate\Database\Seeder;

class EntriesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // para generar entradas para cada id de usuario:
        $users = User::all();

        $users->each(function ($user) {
            factory(Entry::class, 10)->create([
                'user_id' => $user->id     // con esto sobreescribimos el ID que setea el factory
            ]);
        }); 

        
    }
}
