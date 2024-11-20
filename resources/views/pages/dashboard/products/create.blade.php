<x-layouts.admin>
<div class="container mx-auto py-12">
    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <h3 class="text-2xl font-semibold mb-6">Add a Product</h3>
            <form action="{{ route('products.store') }}" method="post">
@csrf
<div class="mb-4">
    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
    <input type="text" id="name" name="name" required
           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
</div>

<div class="mb-4">
    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
    <textarea id="description" name="description" rows="3"
              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
</div>

<div class="mb-4">
    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
    <input type="text" id="slug" name="slug" required
           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
</div>

<div class="mb-4">
    <label for="sku" class="block text-sm font-medium text-gray-700">Sku</label>
    <input type="text" id="sku" name="sku"
           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
</div>


<div class="mt-6">
    <button type="submit"
            class="w-full bg-indigo-600 text-black py-2 px-4 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Create product
    </button>
</div>

</form>
</div>
</div>
</div>
</x-layouts.admin>
