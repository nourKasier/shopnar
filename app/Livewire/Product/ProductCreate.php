<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductCreate extends Component
{
    public $name;
    public $description;
    public $price;
    public $image;
    public $category_id;

    public function createProduct()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Upload the image
        $imagePath = $validatedData['image']->store('products', 'public');

        // Create the product
        $product = Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'image' => $imagePath,
            'category_id' => $validatedData['category_id'],
        ]);

        // Clear the form fields
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->image = '';
        $this->category_id = '';

        // Show a success message
        // session()->flash('success', 'Product created successfully.');

        return redirect()->route('products.index');
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.product.product-create', compact('categories'));
    }
}
