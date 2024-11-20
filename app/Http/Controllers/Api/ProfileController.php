<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $user =  User::find($id);
        if ($request->roll == 'victim') {
            $request->validate([
                'roll' => 'required',
                'name' => 'required|max:255',
                'nid' => 'required',
                'description' => 'required',
                'reference' => 'required',
                'party_designation' => 'required',
                'location' => 'required',
                'category' => 'required',
                'organization' => 'required',
                'bkash_number' => 'required',
            ]);
        }
        $data = $user->update([
            'name' => $request->name,
            'role_id' => 2,
            'nid' => $request->nid,
            'problem_description' => $request->description,
            'reference' => $request->reference,
            'party_designation' => $request->party_designation,
            'location' => $request->location,
            'category' => $request->category,
            'organization' => $request->organization,
            'bank_info' => $request->bkash_number,
        ]);


        // $user = User::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
