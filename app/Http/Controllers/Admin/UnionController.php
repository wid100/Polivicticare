<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Union;

class UnionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unions = Union::with('district')->get();
        return view('admin.unions.index', compact('unions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = \App\District::all();
        return view('admin.unions.create', compact('districts'));
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
            'district_id' => 'required',
            'name' => 'required',
        ]);

        Union::create($request->only('district_id', 'name'));

        return redirect()->route('admin.union.index')->with('success', 'Union created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $union = Union::with('district')->findOrFail($id);
        return view('admin.unions.show', compact('union'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $union = Union::findOrFail($id);
        $districts = \App\District::all();
        return view('admin.union.edit', compact('union', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string|max:255',
        ]);

        $union = Union::findOrFail($id);
        $union->update($request->only('district_id', 'name'));

        return redirect()->route('admin.union.index')->with('success', 'Union updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $union = Union::findOrFail($id);
        $union->delete();

        return redirect()->route('admin.union.index')->with('success', 'Union deleted successfully.');
    }
}
