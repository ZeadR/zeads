<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $job->title }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <div class="text-sm text-gray-600 mb-2">{{ $job->company }} • {{ $job->location }} • {{ $job->type }}</div>
                <div class="prose max-w-none">{!! $job->description !!}</div>
                <div class="mt-6 flex gap-2">
                    @auth
                        <form method="post" action="{{ route('jobs.apply', $job) }}">
                            @csrf
                            <x-primary-button>Apply Now</x-primary-button>
                        </form>
                        @if(auth()->user()->hasAnyRole(['Employer','Admin','Super Admin']) && auth()->id() === $job->employer_id)
                            <a href="{{ route('jobs.edit', $job) }}" class="text-indigo-700">Edit</a>
                            <a href="{{ url("jobs/{$job->id}/applicants") }}" class="text-indigo-700">View Applicants</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-indigo-700">Login to apply or bookmark</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


