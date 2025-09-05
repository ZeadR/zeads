<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jobs</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <table class="w-full text-sm">
                    <thead><tr class="text-left"><th>Title</th><th>Employer</th><th>Location</th><th>Type</th><th>Featured</th><th></th></tr></thead>
                    <tbody>
                    @foreach($jobs as $j)
                        <tr class="border-b">
                            <td><a class="text-indigo-700" href="{{ route('jobs.show', $j) }}">{{ $j->title }}</a></td>
                            <td>{{ optional($j->employer)->name }}</td>
                            <td>{{ $j->location }}</td>
                            <td>{{ $j->type }}</td>
                            <td>{{ $j->is_featured ? 'Yes' : 'No' }}</td>
                            <td class="text-right flex gap-2 justify-end">
                                <form method="post" action="{{ route('admin.jobs.feature', $j) }}">
                                    @csrf
                                    @method('PATCH')
                                    <x-secondary-button>{{ $j->is_featured ? 'Unfeature' : 'Feature' }}</x-secondary-button>
                                </form>
                                <form method="post" action="{{ route('admin.jobs.delete', $j) }}" onsubmit="return confirm('Delete job?')">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button>Delete</x-danger-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-4">{{ $jobs->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>


