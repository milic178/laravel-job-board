<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __invoke(Tag $tag)
    {
        // Paginate jobs related to the tag, with employer and tags eager loaded
        $jobs = $tag->jobs()->with(['employer', 'tags'])->simplePaginate(10);

        return view('results', ['jobs' => $jobs]);
    }

}
