<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Saved Jobs</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse(auth()->user()->bookmarks as $bm)
                        <div class="border-b py-3 flex items-center justify-between">
                            <a class="font-medium" href="{{ route('jobs.show', $bm->job) }}">{{ $bm->job->title }}</a>
                            <form method="post" action="{{ route('jobs.unbookmark', $bm->job) }}">
                                @csrf
                                @method('DELETE')
                                <x-danger-button>Remove</x-danger-button>
                            </form>
                        </div>
                    @empty
                        <div>No bookmarks yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


