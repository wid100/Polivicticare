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
        $districts = District::where('division_id', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $districts,
        ]);
    }
    public function thana($id)
    {
        $thanas = District::find($id)?->thanas;

        if ($thanas) {
            return response()->json([
                'success' => true,
                'data' => $thanas,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'No thanas found for the given district ID.',
        ], 404);
    }

    public function unions($id) // Get thana ID
    {
        $thana = Thana::find($id);

        if (!$thana) {
            return response()->json([
                'success' => false,
                'message' => 'Thana not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $thana->unions,
        ]);
    }

    public function pourashava($id) // Get thana ID
    {
        $thana = Thana::find($id);

        if (!$thana) {
            return response()->json([
                'success' => false,
                'message' => 'Thana not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $thana->pourashava,
        ]);
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
