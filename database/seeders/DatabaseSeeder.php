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
        // Create Supervisor
        User::factory()->create([
            'name' => 'Supervisor Gudang',
            'email' => 'supervisor@test.com',
            'password' => bcrypt('password'),
            'role' => 'supervisor',
        ]);

        // Create Staff
        User::factory()->create([
            'name' => 'Staff Gudang',
            'email' => 'staff@test.com',
            'password' => bcrypt('password'),
            'role' => 'staff',
        ]);

        $this->call([
            CategorySeeder::class,
        ]);
    }
}
