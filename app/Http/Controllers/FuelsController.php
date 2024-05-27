<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class FuelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $fuels = Fuel::all();
            return response()->json($fuels);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve fuels',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'fuel' => 'required|string|max:255',
            ]);

            $fuel = Fuel::create($request->all());

            return response()->json([
                'message' => 'Fuel created successfully',
                'fuel' => $fuel
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create fuel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Fuel $fuel)
    {
        try {
            return response()->json($fuel);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Fuel not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve fuel',
                'error' => $e->getMessage()
            ], 500);
        }
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
        try {
            $request->validate([
                'name' => 'required|string|min:1|max:255',
            ]);

            $fuel->update($request->all());

            return response()->json([
                'message' => 'Fuel updated successfully',
                'fuel' => $fuel
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Fuel not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update fuel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fuel $fuel)
    {
        try {
            $fuel->delete();

            return response()->json([
                'message' => 'Fuel deleted successfully'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Fuel not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete fuel',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
