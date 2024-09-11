<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;

class PostController extends Controller
{
    public function store(Request $request, Website $website) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        $post = $website->posts()->create($validated);
        return response()->json($post, 201);
    }
}
