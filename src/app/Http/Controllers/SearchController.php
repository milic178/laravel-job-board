<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class SearchController extends Controller
{
    public function searchAll()
    {
        $searchString = request('q');
        $jobs = [];
        if(strlen($searchString) < 2) {
            return view('results', compact('jobs', 'searchString'));
        }
        $searchService = new SearchService();
        $jobs = $searchService->searchAll($searchString);

        return view('results', compact('jobs', 'searchString'));
    }

    public function searchEmployer()
    {
        $searchString = request('q');
        $employers = [];

        if(strlen($searchString) < 2) {
            return view('employers.results', compact('employers', 'searchString'));
        }

        $searchService = new SearchService();
        $employers = $searchService->searchEmployerByName($searchString);

        return view('employers.results', compact('employers', 'searchString'));
    }

    public function autocompleteJobs(Request $request)
    {
        return response(404);
       /*  $searchString = $request->get('q', '');

        $searchService = new SearchService();
        $jobs = $searchService->searchAll($searchString,50, 50);

        return response()->json($jobs);
       */
    }

    public function autocompleteEmployer(Request $request){
        $searchString = $request->get('q', '');

        $searchService = new SearchService();
        $jobs = $searchService->autocompleteEmployer($searchString,40, 40);

        return response()->json($jobs);
    }
}
