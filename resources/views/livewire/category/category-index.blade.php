<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        @if (session()->has('message'))
                            <div id="flash-message" class="alert alert-success mb-4">
                                {{ session('message') }}
                            </div>
                            <script>
                                setTimeout(function() {
                                    document.getElementById('flash-message').style.display = 'none';
                                }, 5000);
                            </script>
                        @endif
                        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-4">Create Category</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Parent Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->parent ? $category->parent->name : 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                                            <button wire:click.prevent="deleteCategory({{ $category->id }})" wire:loading.attr="disabled" wire:target="deleteCategory({{ $category->id }})" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }} <!-- Add pagination links -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>