<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
class CategoryIndex extends Component
{
    use WithPagination;
    public function render()
    {
        // $categories = Category::all();
        $categories = Category::paginate(10);

        return view('livewire.category.category-index', compact('categories'));
    }

    public function deleteCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        // Delete associated products
        $category->products()->delete();

        // Delete the category itself
        $category->delete();

        session()->flash('message', 'Category and associated products deleted successfully.');

        // Redirect to the same page
        return $this->redirect(route('categories.index'));
    }
}
