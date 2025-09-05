<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="font-semibold mb-2">Stats</h3>
                <div class="flex gap-6 text-sm text-gray-600">
                    <div>Users: <strong>{{ $stats['users'] ?? '-' }}</strong></div>
                    <div>Jobs: <strong>{{ $stats['jobs'] ?? '-' }}</strong></div>
                    <div>Applications: <strong>{{ $stats['applications'] ?? '-' }}</strong></div>
                </div>
            </div>
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="font-semibold mb-2">Manage</h3>
                <div class="flex gap-4">
                    <a href="{{ route('admin.users') }}" class="text-indigo-700">Users</a>
                    <a href="{{ route('admin.jobs') }}" class="text-indigo-700">Jobs</a>
                    <a href="{{ route('admin.applications') }}" class="text-indigo-700">Applications</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


