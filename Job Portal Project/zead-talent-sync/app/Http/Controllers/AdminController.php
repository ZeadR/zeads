<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected function ensureAdmin(): void
    {
        if (!auth()->check() || !auth()->user()->hasAnyRole(['Admin','Super Admin'])) {
            abort(403);
        }
    }

    public function dashboard()
    {
        $this->ensureAdmin();
        $stats = [
            'users' => User::count(),
            'jobs' => Job::count(),
            'applications' => Application::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function usersIndex()
    {
        $this->ensureAdmin();
        $users = User::with('roles')->latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function jobsIndex()
    {
        $this->ensureAdmin();
        $jobs = Job::with('employer')->latest()->paginate(15);
        return view('admin.jobs', compact('jobs'));
    }

    public function applicationsIndex()
    {
        $this->ensureAdmin();
        $applications = Application::with(['user','job'])->latest()->paginate(15);
        return view('admin.applications', compact('applications'));
    }

    public function toggleFeature(Job $job)
    {
        $this->ensureAdmin();
        $job->is_featured = ! $job->is_featured;
        $job->save();
        return back()->with('status', 'Job feature status updated.');
    }

    public function deleteUser(User $user)
    {
        $this->ensureAdmin();
        $user->delete();
        return back()->with('status', 'User deleted.');
    }

    public function deleteJob(Job $job)
    {
        $this->ensureAdmin();
        $job->delete();
        return back()->with('status', 'Job deleted.');
    }

    public function deleteApplication(Application $application)
    {
        $this->ensureAdmin();
        $application->delete();
        return back()->with('status', 'Application deleted.');
    }
}


