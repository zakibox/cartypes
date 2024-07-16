<?php
namespace App\Http\Controllers;

use App\Http\Resources\FuelsResource;
use App\Models\Fuel;
use Illuminate\Http\Request;

class fuelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fuels = Fuel::all();
        return FuelsResource::collection($fuels);
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
            'message' => 'Fuel created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fuel $fuel)
    {
        return new FuelsResource($fuel);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fuel $fuel)
    {
        $request->validate([
            'fuel' => 'required|string|min:1|max:255',
        ]);

        $fuel->update($request->all());

        return response()->json([
            'message' => 'Fuel updated successfully'
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
