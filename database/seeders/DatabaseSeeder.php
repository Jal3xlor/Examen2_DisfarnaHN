<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Administrador DISFARMA',
            'email' => 'admin@disfarma.hn',
            'password' => 'Admin12345',
            'rol' => 'Administrador',
            'cambiar_password' => false,
        ]);
    }
}
