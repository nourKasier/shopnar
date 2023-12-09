<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryIndex extends Component
{
    public function render()
    {
        $categories = Category::all();

        return view('livewire.category.category-index', compact('categories'));
    }

    public function deleteCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        // Delete associated products
        $category->products()->delete();

        // Delete the category itself
        $category->delete();
        return redirect()->route('categories.index');
        // session()->flash('message', 'Category and associated products deleted successfully.');
    }
}
