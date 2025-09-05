<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Job</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <form method="post" action="{{ route('jobs.store') }}">
                    @csrf
                    <div class="grid gap-4">
                        <x-input-label>Title</x-input-label>
                        <x-text-input name="title" class="w-full" required />

                        <x-input-label>Company</x-input-label>
                        <x-text-input name="company" class="w-full" />

                        <x-input-label>Location</x-input-label>
                        <x-text-input name="location" class="w-full" />

                        <x-input-label>Type</x-input-label>
                        <x-text-input name="type" class="w-full" />

                        <x-input-label>Category</x-input-label>
                        <x-text-input name="category" class="w-full" />

                        <x-input-label>Salary Min</x-input-label>
                        <x-text-input type="number" name="salary_min" class="w-full" />

                        <x-input-label>Salary Max</x-input-label>
                        <x-text-input type="number" name="salary_max" class="w-full" />

                        <x-input-label>Description</x-input-label>
                        <textarea id="description" name="description" class="border rounded w-full p-2" rows="6"></textarea>
                        <script>CKEDITOR.replace('description');</script>

                        <div>
                            <x-primary-button>Save</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


