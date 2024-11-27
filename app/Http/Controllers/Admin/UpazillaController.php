<?php

namespace App\Http\Controllers\Admin;

use App\District;
use App\Division;
use App\Http\Controllers\Controller;

use App\Models\Admin\Upazilla;
use App\Thana;
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
        $upazillas = Thana::with('district')->orderBy('id', 'desc')->get();
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
        $thanas = Thana::all();
        $division = Division::all();
        return view('admin.upazilla.create', compact('districts', 'thanas', 'division'));
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
            'upazilla_name' => ['required', 'string', 'max:255'],
            'district' => ['required'],
        ]);

        Thana::create([
            'name' => $request->upazilla_name,
            'district_id' => $request->district,
            'bn_name' => $request->upazilla_name,
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
    public function destroy($id)
    {
        $thana = Thana::find($id);
        $thana->delete();
        return redirect()->route('admin.upazilla.index')->with('success', 'Upazilla deleted successfully!');
    }
}
