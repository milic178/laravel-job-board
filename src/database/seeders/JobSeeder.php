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
        // Ensure tags are available
        $tags = Tag::all();

        // Ensure employers are available
        $employers = Employer::all();

        // Create jobs and associate them with random employers and tags
        Job::factory(20)->create(new Sequence(
            [
                'featured' => false,
                'schedule' => 'Full Time',
                'employer_id' => $employers->random()->id,
            ],
            [
                'featured' => true,
                'schedule' => 'Part Time',
                'employer_id' => $employers->random()->id,
            ]
        ))->each(function ($job) use ($tags) {
            // Attach 1 to 4 random tags to each job
            $randomTags = $tags->random(rand(1, 4))->pluck('id')->toArray();
            $job->tags()->attach($randomTags);
        });
    }
}
