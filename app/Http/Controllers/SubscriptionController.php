<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\User;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request, Website $website) {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);
    
        $user = User::firstOrCreate(['email' => $validated['email']]);
    
        if ($user->subscriptions()->where('website_id', $website->id)->exists()) {
            return response()->json(['message' => 'Already subscribed'], 400);
        }
    
        $user->subscriptions()->create(['website_id' => $website->id]);
        return response()->json(['message' => 'Subscribed successfully'], 201);
    }
}
