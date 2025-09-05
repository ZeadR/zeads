<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Job::query();
        if ($search = $request->string('q')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('company', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }
        foreach (['category','location','type'] as $field) {
            if ($request->filled($field)) {
                $query->where($field, $request->get($field));
            }
        }
        if ($request->filled('featured')) {
            $query->where('is_featured', (bool)$request->boolean('featured'));
        }
        $jobs = $query->latest()->paginate(10)->withQueryString();
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Auth::check() || ! Auth::user()->hasRole('Employer')) {
            return redirect()->route('jobs.index')->with('status', 'Only employers/admins can post jobs.');
        }
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Auth::check() || ! Auth::user()->hasRole('Employer')) {
            return redirect()->route('jobs.index')->with('status', 'Only employers/admins can post jobs.');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:100',
            'salary_min' => 'nullable|integer|min:0',
            'salary_max' => 'nullable|integer|min:0',
            'category' => 'nullable|string|max:100',
            'is_featured' => 'sometimes|boolean',
            'description' => 'required|string',
        ]);
        $validated['employer_id'] = Auth::id();
        $job = Job::create($validated);
        return redirect()->route('jobs.show', $job)->with('status', 'Job created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        if (! Auth::check() || (! Auth::user()->hasRole('Employer') && Auth::id() !== $job->employer_id)) {
            return redirect()->route('jobs.index')->with('status', 'Not authorized to edit this job.');
        }
        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        if (! Auth::check() || (! Auth::user()->hasRole('Employer') && Auth::id() !== $job->employer_id)) {
            return redirect()->route('jobs.index')->with('status', 'Not authorized to update this job.');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:100',
            'salary_min' => 'nullable|integer|min:0',
            'salary_max' => 'nullable|integer|min:0',
            'category' => 'nullable|string|max:100',
            'is_featured' => 'sometimes|boolean',
            'description' => 'required|string',
        ]);
        $job->update($validated);
        return redirect()->route('jobs.show', $job)->with('status', 'Job updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        if (! Auth::check() || (! Auth::user()->hasRole('Employer') && Auth::id() !== $job->employer_id)) {
            return redirect()->route('jobs.index')->with('status', 'Not authorized to delete this job.');
        }
        $job->delete();
        return redirect()->route('jobs.index')->with('status', 'Job deleted.');
    }

    public function myApplicants()
    {
        if (! Auth::check() || ! Auth::user()->hasRole('Employer')) {
            return redirect()->route('jobs.index');
        }
        $jobs = Job::withCount('applications')->where('employer_id', Auth::id())->latest()->paginate(10);
        return view('employer.applicants', compact('jobs'));
    }

    public function bookmark(Job $job)
    {
        if (!Auth::check() || Auth::user()->hasAnyRole(['Employer','Admin','Super Admin'])) {
            return back();
        }
        Bookmark::firstOrCreate([
            'user_id' => Auth::id(),
            'job_id' => $job->id,
        ]);
        return back()->with('status', 'Job bookmarked.');
    }

    public function unbookmark(Job $job)
    {
        if (Auth::check()) {
            Bookmark::where('user_id', Auth::id())->where('job_id', $job->id)->delete();
        }
        return back()->with('status', 'Bookmark removed.');
    }

    public function applicants(Job $job)
    {
        if (! Auth::check() || (! Auth::user()->hasAnyRole(['Employer','Admin','Super Admin']) && Auth::id() !== $job->employer_id)) {
            abort(403);
        }
        $job->load(['applications.user']);
        return view('jobs.applicants', compact('job'));
    }
}
