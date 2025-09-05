<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Applications</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <table class="w-full text-sm">
                    <thead><tr class="text-left"><th>Job</th><th>Applicant</th><th>Status</th><th></th></tr></thead>
                    <tbody>
                    @foreach($applications as $a)
                        <tr class="border-b">
                            <td><a class="text-indigo-700" href="{{ route('jobs.show', $a->job) }}">{{ $a->job->title }}</a></td>
                            <td>{{ $a->user->name }} ({{ $a->user->username }})</td>
                            <td>{{ $a->status }}</td>
                            <td class="text-right">
                                <form method="post" action="{{ route('admin.apps.delete', $a) }}" onsubmit="return confirm('Delete application?')">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button>Delete</x-danger-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-4">{{ $applications->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>


