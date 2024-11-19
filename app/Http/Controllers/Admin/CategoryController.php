<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|string',
        ]);

        // Convert "on" to 1 and handle unchecked state
        $data = $request->all();
        $data['status'] = $request->status === 'on' ? 1 : 0;

        Category::create($data);

        return redirect()->route('admin.categorys.index')->with('success', 'Category created successfully!');
    }




    // Display the specified resource
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|string',
        ]);

        // Convert "on" to 1 and handle unchecked state
        $data = $request->all();
        $data['status'] = $request->status === 'on' ? 1 : 0;

        $category = Category::findOrFail($id);
        $category->update($data);

        return redirect()->route('admin.categorys.index')->with('success', 'Category updated successfully!');
    }



    // Remove the specified resource from storage
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categorys.index')->with('success', 'Category deleted successfully!');
    }
}
