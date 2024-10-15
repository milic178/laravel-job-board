<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index()
    {
        dd('Employer controller, index');
        $employers = Employer::all();

        return view('employers.index', compact('employers'));
    }
}
