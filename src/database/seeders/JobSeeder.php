<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Tag;
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
        $tags = Tag::factory(3)->create();

        Job::factory(20)->create(new Sequence(
            [
                'featured' => false,
                'schedule' => 'Full Time',
            ],
            [
                'featured' => true,
                'schedule' => 'Part Time',
            ]
        ))->each(function ($job) use ($tags) {
            // Attach 1 to 3 random tags to each job
            $job->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
