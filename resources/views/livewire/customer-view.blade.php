<!-- <div>
    {{-- Stop trying to control. --}}
</div> -->
<div class="container">
    <div class="welcome-section">
        <h1>Welcome to the Customer View</h1>
    </div>

    <div class="filter-section">
        <label for="category">Filter by Category:</label>
        <select wire:model="selectedCategory">
            <option value="">All Categories</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- <div class="filter-section">
        <label for="price">Filter by Price:</label>
        <select wire:model="selectedPrice" id="price">
            <option value="">All Prices</option>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
    </div> -->
    <input type="text" wire:model="inputValue">
    <div>
    <h1>{{ $count }}</h1>

    <button wire:click="increment">+</button>

    <button wire:click="decrement">-</button>
</div>
    <ul class="product-list">
        @foreach($products as $product)
        <li>{{ $product->name }} - {{ $product->price }}</li>
        @endforeach
    </ul>
</div>