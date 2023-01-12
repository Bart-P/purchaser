<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        \App\Models\User::factory()->create([
             'name' => 'Bartek',
             'email' => 'bar-p@wp.pl',
             'password' => bcrypt('asdfasdf'),
        ]);

        \App\Models\Supplier::factory(100)->create();

    }
}