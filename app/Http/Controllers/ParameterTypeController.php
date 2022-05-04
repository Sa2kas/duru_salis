<?php

namespace App\Http\Controllers;

use App\Models\ParameterType;
use Illuminate\Http\Request;
use App\Http\Resources\ParameterType as ParameterTypeResource;

class ParameterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ParameterTypeResource::collection(ParameterType::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paramType = !empty($request->input('id')) ? ParameterType::findOrFail($request->input('id')) : new ParameterType;
        $paramType->title = $request->input('title');
        $paramType->allow_many = $request->input('allow_many');
        $paramType->save();
        return new ParameterTypeResource($paramType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParameterType  $parameterType
     * @return \Illuminate\Http\Response
     */
    public function show(ParameterType $parameterType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParameterType  $parameterType
     * @return \Illuminate\Http\Response
     */
    public function edit(ParameterType $parameterType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParameterType  $parameterType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParameterType $parameterType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParameterType  $parameterType
     * @return \Illuminate\Http\Response
     */
    public function destroy($parameterType)
    {
        ParameterType::find($parameterType)->delete();
        return ParameterTypeResource::collection(ParameterType::get());
    }
}
