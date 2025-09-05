<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Applications</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @php($apps = auth()->user()->load(['applications.job'])->applications ?? collect())
                    @forelse($apps as $app)
                        <div class="border-b py-3">
                            <a class="font-medium" href="{{ route('jobs.show', $app->job) }}">{{ $app->job->title }}</a>
                            <div class="text-sm text-gray-600">Status: {{ $app->status }}</div>
                        </div>
                    @empty
                        <div>You have not applied to any jobs yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


