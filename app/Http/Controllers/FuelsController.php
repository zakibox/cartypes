<?php
namespace App\Http\Controllers;

use App\Models\Fuel;
use Illuminate\Http\Request;

class FuelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fuels = Fuel::all();
        return response()->json($fuels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fuel' => 'required|string|max:255',
        ]);

        $fuel = Fuel::create($request->all());

        return response()->json([
            'message' => 'Fuel created successfully',
            'fuel' => $fuel
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fuel $fuel)
    {
        return response()->json($fuel);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fuel $fuel)
    {
        // Not applicable for API. You can remove this method or handle differently.
        return response()->json([
            'message' => 'This endpoint is not used for APIs'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fuel $fuel)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
        ]);

        $fuel->update($request->all());

        return response()->json([
            'message' => 'Fuel updated successfully',
            'fuel' => $fuel
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fuel $fuel)
    {
        $fuel->delete();

        return response()->json([
            'message' => 'Fuel deleted successfully'
        ]);
    }
}
