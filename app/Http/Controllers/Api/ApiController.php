<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FoundCategory;

class ApiController extends Controller
{
    public function index()
    {
        // Fetch FoundCategory records with status == 1
        $foundCategories = FoundCategory::where('status', 1)->get();

        // Return the data as a JSON response
        return response()->json([
            'success' => true,
            'data' => $foundCategories,
        ]);
    }
}
