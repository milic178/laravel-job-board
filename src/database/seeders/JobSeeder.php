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
        $tags = Tag::factory(6)->create();

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
            // Attach 1 to 4 random tags to each job
            $job->tags()->attach(
                $tags->random(rand(1, 4))->pluck('id')->toArray()
            );
        });
    }
}
