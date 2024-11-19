<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        // Get only organization with status == 1
        $organization = Organization::where('status', 1)->get();

        // Return the data as JSON
        return response()->json([
            'success' => true,
            'data' => $organization
        ]);
    }
}
