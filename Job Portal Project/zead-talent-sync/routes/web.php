<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect()->route('jobs.index');
});

// Test route to verify server is working
Route::get('/test', function () {
    return 'Server is working! Routes are loading.';
});

Route::get('/dashboard', function () {
    return redirect()->route('jobs.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public job listing
Route::resource('jobs', JobController::class)->only(['index','show']);
Route::get('jobs/{job}/apply', [ApplicationController::class, 'create'])->name('jobs.apply.form');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Employer job management (controller enforces Employer role)
    Route::get('jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
    Route::get('employer/applicants', [JobController::class, 'myApplicants'])->name('employer.applicants');
    Route::get('jobs/{job}/applicants', [JobController::class, 'applicants'])->name('jobs.applicants');
    Route::post('jobs/{job}/apply', [ApplicationController::class, 'store'])->name('jobs.apply');
    Route::get('applications', function() { return view('jobs.my-applications'); })->name('applications.mine');
    // Bookmarks restored
    Route::post('jobs/{job}/bookmark', [JobController::class, 'bookmark'])->name('jobs.bookmark');
    Route::delete('jobs/{job}/bookmark', [JobController::class, 'unbookmark'])->name('jobs.unbookmark');
    Route::get('bookmarks', function() { return view('jobs.bookmarks'); })->name('bookmarks.index');
    Route::middleware('role:Admin|Super Admin')->group(function () {
        Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('admin/users', [AdminController::class, 'usersIndex'])->name('admin.users');
        Route::delete('admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
        Route::get('admin/jobs', [AdminController::class, 'jobsIndex'])->name('admin.jobs');
        Route::patch('admin/jobs/{job}/feature', [AdminController::class, 'toggleFeature'])->name('admin.jobs.feature');
        Route::delete('admin/jobs/{job}', [AdminController::class, 'deleteJob'])->name('admin.jobs.delete');
        Route::get('admin/applications', [AdminController::class, 'applicationsIndex'])->name('admin.applications');
        Route::delete('admin/applications/{application}', [AdminController::class, 'deleteApplication'])->name('admin.apps.delete');
    });
});

// Shortcut routes to login with role context (same login form)
Route::get('/admin', function () { return redirect()->route('login', ['role' => 'admin']); });
Route::get('/employer', function () { return redirect()->route('login', ['role' => 'employer']); });

require __DIR__.'/auth.php';
