<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class CustomerView extends Component
{
    public $selectedCategory;
    public $selectedPrice;
    public $inputValue;
    public $count = 1;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        $categories = Category::all();
        $productsQuery = Product::query();

        if ($this->selectedCategory) {
            $productsQuery->where('category_id', "=", $this->selectedCategory);
        }

        if ($this->selectedPrice) {
            if ($this->selectedPrice === 'low') {
                $productsQuery->where('price', '<', 50);
            } elseif ($this->selectedPrice === 'medium') {
                $productsQuery->whereBetween('price', [50, 100]);
            } elseif ($this->selectedPrice === 'high') {
                $productsQuery->where('price', '>', 100);
            }
        }

        $products = $productsQuery->get();

        return view('livewire.customer-view', compact('categories', 'products'));
    }
}
