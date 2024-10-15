<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::all();
        $employers = Employer::all();

        if ($tags->isEmpty() || $employers->isEmpty()) {
            dd('No tags or employers available to create jobs.');
        }

        foreach (range(1, 9000) as $index) {
            $featured = $index % 2 === 0; // Alternates featured jobs
            $schedule = $featured ? 'Part Time' : 'Full Time';
            $employerId = $employers->random()->id;

            // var_dump("Creating job with: featured={$featured}, schedule={$schedule}, employer_id={$employerId}");

            try {
                $job = Job::factory()->create([
                    'featured' => $featured,
                    'schedule' => $schedule,
                    'employer_id' => $employerId,
                ]);
            } catch (\Exception $e) {
                var_dump('Job creation failed: ' . $e->getMessage());
            }

            // Attach 1 to 4 random tags to each job
            $randomTags = $tags->random(rand(1, 4))->pluck('id')->toArray();
            $job->tags()->attach($randomTags);
        }
    }


}
