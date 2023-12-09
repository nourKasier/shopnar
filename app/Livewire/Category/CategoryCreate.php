<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryCreate extends Component
{
    public $name;
    public $parent_id;

    public function render()
    {
        return view('livewire.category.category-create', [
            'parentCategories' => Category::all(),
        ]);
    }

    public function createCategory()
    {
        $this->validate([
            'name' => 'required|unique:categories',
        ]);

        Category::create([
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ]);

        // session()->flash('message', 'Category created successfully.');

        $this->reset();
        return redirect()->route('categories.index');
    }
}
