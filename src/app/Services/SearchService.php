<?php

namespace App\Services;

use App\Models\Employer;
use App\Models\Job;

class SearchService
{
    public function searchAll($searchString, $limit = 400, $perPage = 10)
    {

        /*$jobs = Job::with(['employer','tags'])
            ->where('title', 'LIKE', '%' . request('q') . '%')
            ->get();
        */
        /*$jobs = Job::with(['employer', 'tags'])
            ->whereRaw("MATCH(title, description) AGAINST(?)", [request('q')])
            ->orWhereHas('employer', function ($query) {
                $query->whereRaw("MATCH(name) AGAINST(?)", [request('q')]);
            })
            ->orWhereHas('tags', function ($query) {
                $query->whereRaw("MATCH(name) AGAINST(?)", [request('q')]);
            })
            ->get();
        */

        $jobs = Job::with(['employer', 'tags'])
            ->where('title', 'LIKE', '%' . $searchString . '%')
            ->orWhere('description', 'LIKE', '% ' . $searchString . ' %')
            ->orWhereHas('employer', function ($query) use ($searchString) {
                $query->where('name', 'LIKE', '%' . $searchString . '%');
            })
            ->orWhereHas('tags', function ($query) use ($searchString) {
                $query->where('name', 'LIKE', '%' . $searchString . '%');
            })
            ->limit($limit)
            ->simplePaginate($perPage);

        return $jobs;
    }

    public function searchEmployerByName($searchString, $limit = 40, $perPage = 10)
    {
        $employers = Employer::where('name', 'LIKE', '%' . $searchString . '%')
            ->limit($limit)
            ->simplePaginate($perPage);

        return $employers;
    }

    public function autocompleteEmployer($searchString, $limit = 40, $perPage = 10)
    {
        $employers = Employer::where('name', 'LIKE', '%' . $searchString . '%')
            ->limit($limit)
            ->simplePaginate($perPage, ['id', 'name']);

        return $employers;
    }
}


