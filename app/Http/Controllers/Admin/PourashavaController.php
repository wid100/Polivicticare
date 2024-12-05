<?php

namespace App\Http\Controllers\Admin;

use App\Division;
use App\Http\Controllers\Controller;
use App\Models\Admin\Pourashava;
use App\Thana;
use Illuminate\Http\Request;

class PourashavaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pourashavas = Pourashava::with('district')->get();
        return view('admin.pourashava.index', compact('pourashavas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $thanas = Thana::all();
        $division = Division::all();
        // dd($division->districts);
        return view('admin.pourashava.create', compact('thanas', 'division'));
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
            'name' => 'required',
            'district' => 'required',
        ]);

        Pourashava::create([
            'name' => $request->name,
            'district_id' => $request->district,
        ]);
        return redirect()->route('admin.pourashava.index')->with('success', 'Pourashava created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Pourashava  $pourashava
     * @return \Illuminate\Http\Response
     */
    public function show(Pourashava $pourashava)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Pourashava  $pourashava
     * @return \Illuminate\Http\Response
     */
    public function edit(Pourashava $pourashava)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Pourashava  $pourashava
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pourashava $pourashava)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Pourashava  $pourashava
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pourashava $pourashava)
    {
        $pourashava->delete();
        return redirect()->route('admin.pourashava.index')->with('success', 'Pourashava deleted successfully!');
    }
}
