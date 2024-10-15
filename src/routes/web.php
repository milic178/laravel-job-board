<?php

use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/search', SearchController::class);

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionController::class, 'create']);
    Route::post('/login', [SessionController::class, 'store']);
});

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');

//Jobs
//Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
//Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');

//possible to group routes in controller group (ex: JobsController)
Route::controller(JobController::class)->group(function () {
    Route::get('/', 'index')->name('job.index');
    Route::get('/jobs/create', 'create')
        ->middleware('auth');

    Route::get('/jobs/{job}', 'show');
    Route::post('/jobs', 'store')
        ->middleware('auth');

    Route::get('/jobs/{job}/edit', 'edit')
        ->middleware(['auth', 'can:edit,job']);

    Route::patch('/jobs/{job}', 'update')
        ->middleware('auth')
        ->can('update', 'job');

    Route::delete('/jobs/{job}', 'destroy')
        ->middleware('auth')
        ->can('delete', 'job');
});

Route::controller(EmployerController::class)->group(function () {
    Route::get('/employer', [JobController::class, 'index'])
        ->name('employer.index');
    Route::get('/employer/{employer}', 'show');

    Route::post('/employer', 'store')
        ->middleware('auth');

    Route::get('/employer/{employer}/edit', 'edit')
        ->middleware(['auth', 'can:edit,employer']);

    Route::patch('/employer/{employer}', 'update')
        ->middleware('auth')
        ->can('update', 'employer');
});

Route::get('/search', SearchController::class);
//automatically pass name attribute
Route::get('/tags/{tag:name}', TagController::class); // path by name tags/frontend
