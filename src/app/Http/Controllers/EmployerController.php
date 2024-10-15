<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index()
    {

        $recentEmployers = Employer::latest()->take(3)->get();

        return view('employers.index', compact('recentEmployers'));
    }
}
