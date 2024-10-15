<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users
        $users = User::all();

        // Check if users exist
        if ($users->isEmpty()) {
            dd('No users found to create employers.');
        }

        // Create an employer for each user
        foreach ($users as $user) {
            var_dump('Creating employer for user ID: ' . $user->id);

            try {
                // Create employer and output the result
                $employer = Employer::factory()->create(['user_id' => $user->id]);
                var_dump('Created employer: ', $employer);
            } catch (\Exception $e) {
                dd('Failed to create employer for user ID ' . $user->id . ': ' . $e->getMessage());
            }
        }
    }
}
