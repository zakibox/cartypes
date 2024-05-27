<?php
namespace App\Http\Controllers;

use App\Models\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ModelsController extends Controller
{
    public function index()
    {
        try {
            $models = Models::all();
            return response()->json($models);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve models',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'brand_id'=> 'required|integer',
                'fuel_id' => 'required|integer',
                'category_id' => 'required|integer'
            ]);

            $model = Models::create($request->all());

            return response()->json([
                'message' => 'Model created successfully',
                'model' => $model
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create model',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Models $model)
    {
        try {
            return response()->json($model);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Model not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve model',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Models $model)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'brand_id'=> 'required|integer',
                'fuel_id' => 'required|integer',
                'category_id' => 'required|integer'
            ]);

            $model->update($request->all());

            return response()->json([
                'message' => 'Model updated successfully',
                'model' => $model
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Model not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update model',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Models $model)
    {
        try {
            $model->delete();

            return response()->json([
                'message' => 'Model deleted successfully'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Model not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete model',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
