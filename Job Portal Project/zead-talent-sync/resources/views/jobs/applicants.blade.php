<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Applicants: {{ $job->title }}</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse($job->applications as $app)
                        <div class="border-b py-3">
                            <div class="font-medium">{{ $app->user->name }} ({{ $app->user->username }})</div>
                            <div class="text-sm text-gray-600">Status: {{ $app->status }}</div>
                        </div>
                    @empty
                        <div>No applicants yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


