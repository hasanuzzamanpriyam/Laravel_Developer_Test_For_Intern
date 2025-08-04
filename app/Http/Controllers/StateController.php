<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    // Get all states for a country (AJAX)
    public function index(Request $request)
{
    $states = State::with('country')->get();

    return response()->json([
        'success' => true,
        'data' => $states
    ]);
}


    // Create a new state
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $state = State::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'State created successfully',
            'data' => $state
        ], 201);
    }

    // Show a single state (optional for editing forms)
    public function show($id)
    {
        $state = State::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $state
        ]);
    }

    // Update state
    public function update(Request $request, $id)
    {
        $state = State::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $state->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'State updated successfully',
            'data' => $state
        ]);
    }

    // Delete state (cascades to cities)
    public function destroy($id)
    {
        $state = State::findOrFail($id);
        $state->delete();

        return response()->json([
            'success' => true,
            'message' => 'State and related cities deleted successfully'
        ], 204);
    }
}
