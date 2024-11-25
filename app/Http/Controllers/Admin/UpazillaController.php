<?php

namespace App\Http\Controllers\Admin;

use App\District;
use App\Http\Controllers\Controller;

use App\Models\Admin\Upazilla;
use Illuminate\Http\Request;

class UpazillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $upazillas = Upazilla::with('district')->get();
        return view('admin.upazilla.index', compact('upazillas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::all();
        return view('admin.upazilla.create', compact('districts'));
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
            'name' => ['required', 'string', 'max:255'],
            'district_id' => ['required'],
        ]);

        Upazilla::create([
            'name' => $request->name,
            'district_id' => $request->district_id,
        ]);
        return redirect()->route('admin.upazilla.index')
            ->with('success', 'Upazilla created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Upazilla  $upazilla
     * @return \Illuminate\Http\Response
     */
    public function show(Upazilla $upazilla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Upazilla  $upazilla
     * @return \Illuminate\Http\Response
     */
    public function edit(Upazilla $upazilla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Upazilla  $upazilla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Upazilla $upazilla)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Upazilla  $upazilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Upazilla $upazilla)
    {
        $upazilla->delete();
        return redirect()->route('admin.upazilla.index')->with('success', 'Upazilla deleted successfully!');
    }
}
