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
        $users = User::all();
        if ($users->isEmpty()) {
            dd('No users found to create employers.');
        }

        // Create an employer for each user
        foreach ($users as $user) {
            try {
                $employer = Employer::factory()->create(['user_id' => $user->id]);
            } catch (\Exception $e) {
                dd('Failed to create employer for user ID ' . $user->id . ': ' . $e->getMessage());
            }
        }
    }
}
