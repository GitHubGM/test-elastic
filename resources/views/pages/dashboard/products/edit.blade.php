<x-layouts.admin>
    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3>Update Post</h3>
                <form action="{{ route('products.update', $product->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{ $product->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $product->description }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                        <input type="text" id="slug" name="slug" required
                               value="{{ $product->slug}}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="sku" class="block text-sm font-medium text-gray-700">Sku</label>
                        <input type="text" id="sku" name="sku"
                               value="{{ $product->sku }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <button type="submit" class="btn mt-3 text-black btn-primary">Update Product</button>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>

