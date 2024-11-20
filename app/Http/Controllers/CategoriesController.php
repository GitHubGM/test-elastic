<?php

namespace App\Http\Controllers;

use App\Models\Product\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function create()
    {
        return view('pages.dashboard.categories.create');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('pages.dashboard.categories.edit',compact('category'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('pages.dashboard.categories', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories, slug',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'position' => 'required|integer',
        ]);
        Category::create($request->all());
        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return view('pages.dashboard.categories.show', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'position' => 'required|integer',
        ]);
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
