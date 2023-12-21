<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryEdit extends Component
{
    public $category;
    public $name;
    public $parent_id;

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->parent_id = $category->parent_id;
    }

    public function render()
    {
        return view('livewire.category.category-edit', [
            'parentCategories' => Category::all(),
        ]);
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => 'required|unique:categories,name,' . $this->category->id,
        ]);

        $this->category->update([
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ]);

        session()->flash('message', 'Category updated successfully.');

        // Redirect back to the edit page
        return redirect()->route('categories.edit', $this->category);
    }
}
