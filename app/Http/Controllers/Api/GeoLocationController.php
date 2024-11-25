<?php

namespace App\Http\Controllers\Api;

use App\District;
use App\Division;
use App\Http\Controllers\Controller;
use App\Models\Admin\Upazilla;
use App\Models\Admin\Ward;
use App\Thana;
use Illuminate\Http\Request;

class GeoLocationController extends Controller
{
    public function division()
    {
        $division = Division::all();
        return response()->json($division);
    }
    public function district($id)
    {
        $division = Division::find($id);
        return response()->json($division->districts);
    }
    public function thana($id)
    {
        $district = District::find($id);
        return response()->json($district->thanas);
    }
    public function unions($id) // get thana id
    {
        $thana = Thana::find($id);
        return response()->json($thana->unions);
    }
    public function pourashava($id) // get thana id
    {
        $thana = Thana::find($id);
        return response()->json($thana->pourashava);
    }
    public function ward()
    {
        $word = Ward::all();
        return response()->json($word);
    }
    public function upazilla($id) //  id = upazilla_id
    {
        $upazillas = Upazilla::where('district_id', $id)->get();
        return response()->json($upazillas);
    }
}
