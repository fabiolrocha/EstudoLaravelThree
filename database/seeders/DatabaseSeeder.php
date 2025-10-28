<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use App\Models\Project;
use App\Models\Task;

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

        $userTest->assignRole('user');

        $internalUsers = User::factory(3)->create(['email_verified_at' => now()])->each(function ($user) {
            $user->assignRole('user');
        });


        $internalUsers->push($userTest);
        $internalUsers->push($adminUser);
        $internalUsers->push($meuUser);


        $managerUser1 = User::factory()->create([
            'name' => 'Vitor',
            'email' => 'vitor@gmail.com',
            'password' => Hash::make('rochafabio'),
            'phone' => '11987654321',
            'email_verified_at' => now(),
        ]);
        $managerUser1->assignRole('manager');

        $managerUser2 = User::factory()->create([
            'name' => 'Igor',
            'email' => 'igor@gmail.com',
            'password' => Hash::make('rochafabio'),
            'phone' => '11987654321',
            'email_verified_at' => now(),
        ]);
        $managerUser2->assignRole('manager');


        $company1 = Client::factory()->create([
            'name' => 'Empresa do Manager 1',
            'contact_user_id' => $managerUser1->id
        ]);

        $company2 = Client::factory()->create([
            'name' => 'Empresa do Manager 2',
            'contact_user_id' => $managerUser2->id
        ]);

        $otherCompanies = Client::factory(8)->create();

        $allCompanies = collect([$company1, $company2])->merge($otherCompanies);

        $allCompanies->each(function ($company) {
            Project::factory(rand(1, 3))->create([
                'client_id' => $company->id
            ]);
        });

        $allProjects = Project::all();

        if ($allProjects->isNotEmpty() && $internalUsers->isNotEmpty()) {
            $allProjects->each(function ($project) use ($internalUsers) {
                Task::factory(rand(2, 5))->create([
                    'project_id' => $project->id,
                    'assigned_user_id' => $internalUsers->random()->id
                ]);
            });
        }
    }
}
