<x-layouts.admin>
    <div class="container mx-auto mt-8 px-4">
        <!-- Header section with Back and Add buttons -->
        <div class="flex justify-between items-center mb-6">

            <a href="{{ route('categories.create') }}" class="bg-green-500 text-black px-4 py-2 rounded-lg text-sm hover:bg-green-600">
                Add Category
            </a>
        </div>

        <!-- Grid to display categories -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($categories as $category)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <!-- Category Name Header -->
                    <div class="bg-blue-500 text-white p-4">
                        <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
                    </div>

                    <!-- Category Content -->
                    <div class="p-4">
                        <h4 class="text-gray-700 font-semibold mb-2">{{ $category->slug }}</h4>
                        <p class="text-gray-600 mb-4"><strong>Description:</strong> {{ $category->description }}</p>

                        @if($category->image)
                            <img src="{{ $category->image }}" alt="{{ $category->name }}" class="xl:w-1/2 h-1/2 object-cover rounded-md mb-4">
                        @endif

                        <p class="text-gray-600"><strong>Status:</strong> {{ $category->status ? 'Active' : 'Inactive' }}</p>
                    </div>

                    <!-- Edit and Delete buttons -->
                    <div class="flex justify-between bg-gray-100 px-4 py-3 space-x-4">
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
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
