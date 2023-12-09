<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductEdit extends Component
{
    public $product;
    public $categories;
    public $name;
    public $description;
    public $price;
    public $category_id;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->category_id = $product->category_id;
        $this->categories = Category::all();
    }

    public function updateProduct()
    {
        $validatedData = $this->validate([
            'product.name' => 'required',
            'product.description' => 'required',
            'product.price' => 'required|numeric',
            'product.image' => 'nullable|image',
            'product.category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($this->product['id']);

        // Update the product fields
        $product->name = $validatedData['product']['name'];
        $product->description = $validatedData['product']['description'];
        $product->price = $validatedData['product']['price'];

        // Update the image if a new one is provided
        if ($validatedData['product']['image']) {
            // Upload the new image
            $imagePath = $validatedData['product']['image']->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->category_id = $validatedData['product']['category_id'];
        $product->save();

        // Show a success message
        // session()->flash('success', 'Product updated successfully.');

        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.product.product-edit');
    }
}
