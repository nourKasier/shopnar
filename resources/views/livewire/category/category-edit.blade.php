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

                    <form wire:submit.prevent="updateCategory">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input wire:model="name" type="text" class="form-control" id="name" placeholder="Enter category name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Parent Category</label>
                            <select wire:model="parent_id" class="form-control" id="parent_id">
                                <option value="">None</option>
                                @foreach ($parentCategories as $parentCategory)
                                <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                @endforeach
                            </select>
                            @error('parent_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </form>

                    <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Back</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>