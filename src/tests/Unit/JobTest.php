<?php

namespace Tests\Unit;

use App\Models\Employer;
use App\Models\Job;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    /*public function test_it_belongs_to_employer(): void
    {
        //Arrange
        $employer = Employer::factory()->create();
        $job = Job::factory()->create(['employer_id' => $employer->id]);

        //Act && Assert
        expect($job->employer)->toBeInstanceOf(Employer::class);
    }*/

    public function test_it_can_have_tags(): void {

        $job = Job::factory()->create();
        $job->tag('Frontend');

        expect($job->tag)->toHaveCount(1);
    }
}
