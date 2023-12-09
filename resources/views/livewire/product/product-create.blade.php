<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <h2>Create Product</h2>

                        <form wire:submit.prevent="createProduct">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input wire:model="name" type="text" class="form-control" id="name" placeholder="Enter product name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea wire:model="description" class="form-control" id="description" placeholder="Enter product description"></textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input wire:model="price" type="text" class="form-control" id="price" placeholder="Enter product price">
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input wire:model="image" type="file" class="form-control-file" id="image">
                                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select wire:model="category_id" class="form-control" id="category">
                                    <option value="">Select a category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>