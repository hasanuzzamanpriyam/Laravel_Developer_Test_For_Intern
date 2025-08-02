<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    // Get all countries (for AJAX)
    public function index()
    {
        return response()->json(Country::all());
    }

    // Create a new country
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:countries|max:255',
        ]);

        $country = Country::create($validated);
        return response()->json($country, 201);
    }

    // Update a country
    public function update(Request $request, Country $country)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:countries,name,' . $country->id,
        ]);

        $country->update($validated);
        return response()->json($country);
    }

    // Delete a country (cascades to states/cities via SQL)
    public function destroy(Country $country)
    {
        $country->delete();
        return response()->json(null, 204);
    }
}
