<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Job Posts & Applicants</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse($jobs as $job)
                        <div class="border-b py-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <a class="font-medium text-indigo-700" href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a>
                                    <span class="text-sm text-gray-600">Applicants: {{ $job->applications_count }}</span>
                                </div>
                                <a class="text-sm text-indigo-700" href="{{ route('jobs.applicants', $job) }}">View Applicants</a>
                            </div>
                        </div>
                    @empty
                        <div>No job posts yet.</div>
                    @endforelse
                    <div class="mt-4">{{ $jobs->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


