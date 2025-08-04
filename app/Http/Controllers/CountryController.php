<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    // Get all countries (AJAX)
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Country::all()
        ]);
    }

    // Create a new country
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:countries,name|max:255',
        ]);

        $country = Country::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Country created successfully',
            'data' => $country
        ], 201);
    }

    public function show(Country $country)
    {
        return response()->json([
            'success' => true,
            'data' => $country
        ]);
    }

    // Update a country
    public function update(Request $request, Country $country)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:countries,name,' . $country->id,
        ]);

        $country->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Country updated successfully',
            'data' => $country
        ]);
    }

    // Delete a country (cascades to states & cities via SQL)
    public function destroy(Country $country)
    {
        $country->delete();

        return response()->json([
            'success' => true,
            'message' => 'Country and related states/cities deleted successfully'
        ], 204);
    }
}
