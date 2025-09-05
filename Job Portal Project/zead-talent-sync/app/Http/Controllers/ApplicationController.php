<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job)
    {
        return view('applications.apply', compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $routeJob = $request->route('job');
        $job = $routeJob instanceof Job ? $routeJob : Job::findOrFail($routeJob ?? $request->input('job_id'));

        $application = Application::firstOrCreate([
            'job_id' => $job->id,
            'user_id' => Auth::id(),
        ]);

        // Email notification to employer (logged to storage per .env MAIL_MAILER=log)
        try {
            Mail::raw('New application received for: '.$job->title, function ($m) use ($job) {
                $m->to($job->employer->email)->subject('New Job Application');
            });
        } catch (\Throwable $e) {}

        return back()->with('status', 'Applied successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
}
