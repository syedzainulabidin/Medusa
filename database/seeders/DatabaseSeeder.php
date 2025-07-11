<?php

namespace Database\Seeders;

use App\Models\Child;
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

        // $this->call([
        //     AdminSeeder::class
        // ]);


        // User::factory()->count(5)->hasChildren(3)->create();
        User::factory()->count(10)->create(); 
    }
}
