<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jobs</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="get" class="mb-4 grid grid-cols-1 md:grid-cols-5 gap-2">
                <input class="border rounded p-2" type="text" name="q" value="{{ request('q') }}" placeholder="Search...">
                <input class="border rounded p-2" type="text" name="category" value="{{ request('category') }}" placeholder="Category">
                <input class="border rounded p-2" type="text" name="location" value="{{ request('location') }}" placeholder="Location">
                <select class="border rounded p-2" name="type">
                    <option value="">Type</option>
                    @foreach(['Full-time','Part-time','Contract','Internship'] as $t)
                        <option value="{{ $t }}" @selected(request('type')===$t)>{{ $t }}</option>
                    @endforeach
                </select>
                <button class="bg-indigo-600 text-white rounded px-4">Filter</button>
            </form>

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse($jobs as $job)
                        <div class="border-b py-4">
                            <a class="text-lg font-semibold text-indigo-700" href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a>
                            <div class="text-sm text-gray-600">{{ $job->company }} • {{ $job->location }} • {{ $job->type }}</div>
                            <div class="mt-2 flex gap-2">
                                @auth
                                    @if(!auth()->user()->hasAnyRole(['Employer','Admin','Super Admin']))
                                        <form method="post" action="{{ route('jobs.apply', $job) }}">
                                            @csrf
                                            <x-primary-button>Apply</x-primary-button>
                                        </form>
                                        <form method="post" action="{{ route('jobs.bookmark', $job) }}">
                                            @csrf
                                            <x-secondary-button>Bookmark</x-secondary-button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="text-indigo-700">Login to apply or bookmark</a>
                                @endauth
                            </div>
                        </div>
                    @empty
                        <div class="py-4">No jobs found.</div>
                    @endforelse
                    <div class="mt-4">{{ $jobs->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


