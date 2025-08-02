<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    // Get states by country_id (for dynamic dropdowns)
    public function index(Request $request)
    {
        $states = State::where('country_id', $request->country_id)->get();
        return response()->json($states);
    }

    // Create a new state
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $state = State::create($validated);
        return response()->json($state, 201);
    }

    // Update/Delete methods similar to CountryController
}
