<?php

namespace Database\Seeders;

use App\Models\Conference;
use App\Models\Talk;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()
            ->has(Talk::factory(5))
            ->create([
                'name' => 'Rajan Dangi',
                'email' => 'contact@rajandangi.com.np',
            ]);

        Conference::factory(5)->create();
    }
}
