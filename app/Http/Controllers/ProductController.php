<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('pages.dashboard.products', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'sku' => 'required|string|max:255|unique:products',
        ]);
        Product::create($request->all());
        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
//    public function show(string $id)
//    {
//        $product=Product::find($id);
//        return view('pages.dashboard.products.show', compact('product'));
//    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product=Product::find($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,'.$product->id,
            'sku' => 'required|string|max:255|unique:products,sku,'.$product->id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product=Product::find($id);
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function create()
    {
        return view('pages.dashboard.products.create');
    }

    public function edit(string $id)
    {
        $product=Product::find($id);
        return view('pages.dashboard.products.edit', compact('product'));
    }

}
