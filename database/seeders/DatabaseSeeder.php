<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'admin' => true,
        ]);

        $user1 = \App\Models\User::create([
            'name' => 'Mario Inzirillo',
            'email' => 'mario@gmail.com',
            'password' => Hash::make('secret'),
            'admin' => false,
        ]);

        $user2 = \App\Models\User::create([
            'name' => 'Giggi Piadina',
            'email' => 'giggi@laravel.com',
            'password' => Hash::make('passcode'),
            'admin' => false,
        ]);

        \App\Models\Post::create([
            'user_id' => $user1->id,
            'content' => 'Sono post numero 1'
        ]);

        \App\Models\Post::create([
            'user_id' => $user2->id,
            'content' => 'Sono post numero 2'
        ]);

        \App\Models\Product::create([
            'user_id' => $user1->id,
            'name' => 'Pentola',
            'content' => 'Sono prodotto numero 1',
            'price' => '1.35',
            //'image' => '1',
        ]);

        \App\Models\Product::create([
            'user_id' => $user2->id,
            'name' => 'Pentolona',
            'content' => 'Sono prodotto numero 2',
            'price' => '1.36',
            //'image' => '1',
        ]);
    }
}
