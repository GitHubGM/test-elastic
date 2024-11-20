<x-layouts.admin>
    <div class="container mx-auto mt-8 px-4">
        <!-- Header section with Back and Add buttons -->
        <div class="flex justify-between items-center mb-6">

            <a href="{{ route('products.create') }}" class="bg-green-500 text-black px-4 py-2 rounded-lg text-sm hover:bg-green-600">
                Add Product
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($products as $product)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="bg-blue-500 text-white p-4">
                        <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                    </div>

                    <div class="p-4">
                        <h4 class="text-gray-700 font-semibold mb-2"><b>Slug</b>{{ $product->slug }}</h4>
                        <p class="text-gray-600 mb-4"><strong>Description:</strong> {{ $product->description }}</p>
                        <p class="text-gray-600"><strong>Sku:</strong> {{ $product->sku }}</p>
                    </div>

                    <!-- Edit and Delete buttons -->
                    <div class="flex justify-between bg-gray-100 px-4 py-3 space-x-4">
                        <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.admin>
