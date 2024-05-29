<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarModelResource;
use App\Models\CarModel;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function index()
    {
        $models = CarModel::all();
        return CarModelResource::collection($models);
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

        $model = CarModel::create($request->all());

        return response()->json([
            'message' => 'Model created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarModel $model)
    {
           return new CarModelResource($model);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarModel $model)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|integer',
            'fuel_id' => 'required|integer',
            'category_id' => 'required|integer'
        ]);

        $model->update($request->all());

        return response()->json([
            'message' => 'Model updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $model)
    {
        $model->delete();

        return response()->json([
            'message' => 'Model deleted successfully'
        ]);
    }
}
