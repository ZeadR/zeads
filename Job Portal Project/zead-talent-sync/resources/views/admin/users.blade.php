<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <table class="w-full text-sm">
                    <thead><tr class="text-left"><th>Name</th><th>Username</th><th>Email</th><th>Roles</th><th></th></tr></thead>
                    <tbody>
                    @foreach($users as $u)
                        <tr class="border-b">
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->username }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->roles->pluck('name')->join(', ') }}</td>
                            <td class="text-right">
                                <form method="post" action="{{ route('admin.users.delete', $u) }}" onsubmit="return confirm('Delete user?')">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button>Delete</x-danger-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-4">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>


