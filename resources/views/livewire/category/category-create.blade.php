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
                        <div class="alert alert-success mb-4">
                            {{ session('message') }}
                        </div>
                        @endif

                        <form wire:submit.prevent="createCategory">
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
                            <button type="submit" class="btn btn-primary">Create Category</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>