<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class   SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $searchString = request('q');
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
            ->orWhere('description', 'LIKE', '%' . $searchString . '%')
            ->orWhereHas('employer', function ($query) use ($searchString) {
                $query->where('name', 'LIKE', '%' . $searchString . '%');
            })
            ->orWhereHas('tags', function ($query) use ($searchString) {
                $query->where('name', 'LIKE', '%' . $searchString . '%');
            })
            ->get();


        return view('results', compact('jobs', 'searchString'));
    }
}
