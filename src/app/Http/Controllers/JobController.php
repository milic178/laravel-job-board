<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $featuredJobs = Job::where('featured', true)
            //optimize query
            ->with(['employer', 'tags'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $jobs = Job::all();

        /* $jobs = Job::orderBy('created_at', 'desc')->get();
         $jobs = Job::all();
        */
        /*[$featuredJobs, $nonFeaturedJobs] = $jobs->partition(function ($job) {
            return $job->featured;
        });
        */
        return view('jobs.index', [
            //'lastJobs' => $lastJobs,
            'featuredJobs' => $featuredJobs,
            'jobs' => $jobs,
            'tags' => Tag::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'salary' => 'required',
            'location' => 'required',
            'schedule' => 'required', Rule::in(['Part Time', 'Full Time']),
            'url' => 'required', 'active_url',
            'description' => 'nullable', 'max:1000',
            'tags' => 'nullable',
        ]);

        $attributes['featured'] = $request->has('featured') ? true : false;

        $job = Auth::user()->employer->jobs()->create(
            Arr::except($attributes, ['tags']));

        if($attributes['tags'] ?? false) {
           foreach (explode(',', $attributes['tags']) as $tag) {
               //todo consolidate that all tags are stored equally example frontend, front-end
            $job->tag($tag);
           }
        }

        return redirect()->route('job.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        //validate request
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required', 'min:5'],
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);
        return redirect('/jobs/' . $job->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('job.index');
    }
}
