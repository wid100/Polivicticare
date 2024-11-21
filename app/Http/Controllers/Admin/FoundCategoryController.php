<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\FoundCategory;
use Illuminate\Http\Request;

class FoundCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foundcategories = FoundCategory::all();
        return view('admin.foundcategory.index', compact('foundcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.foundcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|string',
        ]);

        // Convert "on" to 1 and handle unchecked state
        $data = $request->all();
        $data['status'] = $request->status === 'on' ? 1 : 0;

        FoundCategory::create($data);

        return redirect()->route('admin.foundcategory.index')->with('success', 'Found Category created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FoundCategory  $foundCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FoundCategory $foundCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FoundCategory  $foundCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $foundcategory = FoundCategory::findOrFail($id);
        return view('admin.foundcategory.edit', compact('foundcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FoundCategory  $foundCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|string',
        ]);

        // Convert "on" to 1 and handle unchecked state
        $data = $request->all();
        $data['status'] = $request->status === 'on' ? 1 : 0;

        $foundcategory = FoundCategory::findOrFail($id);
        $foundcategory->update($data);

        return redirect()->route('admin.foundcategory.index')->with('success', ' Found Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FoundCategory  $foundCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foundcategory = FoundCategory::findOrFail($id);
        $foundcategory->delete();

        return redirect()->route('admin.foundcategory.index')->with('success', 'Found Category deleted successfully!');
    }
}
