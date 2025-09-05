<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Job</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <form method="post" action="{{ route('jobs.update', $job) }}">
                    @method('PUT')
                    @csrf
                    <div class="grid gap-4">
                        <x-input-label>Title</x-input-label>
                        <x-text-input name="title" class="w-full" value="{{ $job->title }}" required />

                        <x-input-label>Company</x-input-label>
                        <x-text-input name="company" class="w-full" value="{{ $job->company }}" />

                        <x-input-label>Location</x-input-label>
                        <x-text-input name="location" class="w-full" value="{{ $job->location }}" />

                        <x-input-label>Type</x-input-label>
                        <x-text-input name="type" class="w-full" value="{{ $job->type }}" />

                        <x-input-label>Category</x-input-label>
                        <x-text-input name="category" class="w-full" value="{{ $job->category }}" />

                        <x-input-label>Salary Min</x-input-label>
                        <x-text-input type="number" name="salary_min" class="w-full" value="{{ $job->salary_min }}" />

                        <x-input-label>Salary Max</x-input-label>
                        <x-text-input type="number" name="salary_max" class="w-full" value="{{ $job->salary_max }}" />

                        <x-input-label>Description</x-input-label>
                        <textarea id="description" name="description" class="border rounded w-full p-2" rows="6">{{ $job->description }}</textarea>
                        <script>CKEDITOR.replace('description');</script>

                        <div class="flex gap-2">
                            <x-primary-button>Update</x-primary-button>
                            <form method="post" action="{{ route('jobs.destroy', $job) }}" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <x-danger-button>Delete</x-danger-button>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


