<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    // Get cities by state_id (for dynamic dropdowns)
    public function index(Request $request)
    {
        $cities = City::where('state_id', $request->state_id)->get();
        return response()->json($cities);
    }

    // Create a new city
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
        ]);

        $city = City::create($validated);
        return response()->json($city, 201);
    }

    public function show(Request $request, $id)
    {
        // Find the city by ID and return it
        if (!$request->has('state_id')) {
            $request->merge(['state_id' => City::findOrFail($id)->state_id]);
        }
        $validated = $request->validate([
            'state_id' => 'required|exists:states,id',
        ]);
        $city = City::findOrFail($id);
        return response()->json($city);
    }

    // Update an existing city
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
        ]);

        // Find the city by ID and update it
        if (!$request->has('state_id')) {
            $validated['state_id'] = City::findOrFail($id)->state_id;
        }

        $city = City::findOrFail($id);
        $city->update($validated);
        return response()->json($city);
    }

    // Delete a city
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return response()->json(null, 204);
    }
}
