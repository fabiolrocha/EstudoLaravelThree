<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesSeeder::class);

        Client::factory(10)->create();

        $adminUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'phone' => '1234567890',
            'email_verified_at' => now(),
        ]);

        $adminUser->assignRole('admin');

        $meuUser = User::factory()->create([
            'name' => 'Fabio',
            'email' => 'fabiolrocha2013@gmail.com',
            'password' => Hash::make('rochafabio'),
            'phone' => '11987654321',
            'email_verified_at' => now(),
        ]);

        $meuUser->assignRole('admin');

        $userTest = User::factory()->create([
            'name' => 'User Test',
            'email' => 'test@user.com',
            'password' => Hash::make('testuser'),
            'phone' => '10987654321',
            'email_verified_at' => now(),
        ]);
    }
}
