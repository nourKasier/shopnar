<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoryCreate extends Component
{
    use WithFileUploads;

    public $name;
    public $parent_id;

    protected $rules = [
        'name' => 'required|unique:categories',
    ];

    public function render()
    {
        $parentCategories = Category::all();

        return view('livewire.category.category-create', compact('parentCategories'));
    }

    public function createCategory()
    {
        $this->validate();

        Category::create([
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ]);

        session()->flash('message', 'Category created successfully.');

        return redirect()->route('categories.index');
    }
}