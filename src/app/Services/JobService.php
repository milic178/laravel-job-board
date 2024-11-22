<?php

namespace App\Services;

use App\Models\Job;

class JobService
{
    public function updateTagsByName(Job $job, $tags)
    {
        $tags = explode(',', $tags);

        // Get the new tags from the form
        $newTags = array_map(function ($tag) {
            return ucfirst(str_replace(' ', '', trim($tag)));
        }, $tags);

        // Remove duplicate tags
        $newTags = array_unique($newTags);

        // Get the current tags
        $currentTags = $job->tags()->pluck('name')->toArray();

        // Tags to remove (present in current but not in new)
        $tagsToRemove = array_diff($currentTags, $newTags);

        // Tags to add (present in new but not in current)
        $tagsToAdd = array_diff($newTags, $currentTags);

        // Remove tags
        $job->untag($tagsToRemove);

        // Add new tags
        foreach ($tagsToAdd as $tag) {
            $job->tag($tag);
        }
    }
}
