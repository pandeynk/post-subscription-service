<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;

class WebsiteController extends Controller
{
    public function index() {
        $websites = Website::all();
        return response()->json($websites);
    }

    // Create a new website
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|unique:websites,url',
        ]);

        $website = Website::create($validated);
        return response()->json($website, 201);
    }
}
