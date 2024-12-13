<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'name' => 'Test admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'name' => 'Test writer',
            'email' => 'writer@example.com',
            'password' => Hash::make('password'),
            'role' => 'writer',
        ]);
    }
}