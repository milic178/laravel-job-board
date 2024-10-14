<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __invoke(Tag $tag)
    {
        //Tag model is passed automatically(already found by name in router)
        return view('results', ['jobs' => $tag->jobs->load(['employer', 'tags'])]);
    }
}
