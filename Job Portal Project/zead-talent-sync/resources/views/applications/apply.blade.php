<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Apply: {{ $job->title }}</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <form method="post" action="{{ route('jobs.apply', $job) }}">
                    @csrf
                    <x-input-label>Cover Letter</x-input-label>
                    <textarea name="cover_letter" rows="6" class="w-full border rounded p-2"></textarea>
                    <div class="mt-4"><x-primary-button>Submit Application</x-primary-button></div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


