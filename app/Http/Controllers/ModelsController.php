<?php
namespace App\Http\Controllers;

use App\Models\Models;
use Illuminate\Http\Request;

class ModelsController extends Controller
{
    public function index()
    {
        $models = Models::all();
        return response()->json($models);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|integer',
            'fuel_id' => 'required|integer',
            'category_id' => 'required|integer'
        ]);

        $model = Models::create($request->all());

        return response()->json([
            'message' => 'Model created successfully',
            'model' => $model
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Models $model)
    {
        return response()->json($model);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Models $model)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|integer',
            'fuel_id' => 'required|integer',
            'category_id' => 'required|integer'
        ]);

        $model->update($request->all());

        return response()->json([
            'message' => 'Model updated successfully',
            'model' => $model
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Models $model)
    {
        $model->delete();

        return response()->json([
            'message' => 'Model deleted successfully'
        ]);
    }
}
