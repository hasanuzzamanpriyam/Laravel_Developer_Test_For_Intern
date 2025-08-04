<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    // Get all cities for a state
    public function index(Request $request)
{
    $cities = City::with('state.country')->get();

    return response()->json([
        'success' => true,
        'data' => $cities
    ]);
}

    // Create a new city
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
        ]);

        $city = City::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'City created successfully',
            'data' => $city
        ], 201);
    }

    // Show a city (optional for editing)
    public function show($id)
{
    $city = City::with('state.country')->findOrFail($id);

    return response()->json([
        'success' => true,
        'data' => $city
    ]);
}


    // Update city
    public function update(Request $request, City $city)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'state_id' => 'required|exists:states,id',
    ]);

    $city->update($validated);

    return response()->json(['success' => true, 'message' => 'City updated']);
}

    // Delete city
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return response()->json([
            'success' => true,
            'message' => 'City deleted successfully'
        ], 204);
    }
}
