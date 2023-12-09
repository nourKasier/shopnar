<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class ProductIndex extends Component
{
    public function render()
    {
        $products = Product::with('category')->get();

        return view('livewire.product.product-index', [
            'products' => $products,
        ]);
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);

        if ($product) {
            $product->delete();
            return redirect()->route('products.index');
            // session()->flash('message', 'Product deleted successfully.');
        }
    }
}
