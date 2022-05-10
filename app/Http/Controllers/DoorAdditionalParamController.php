<?php

namespace App\Http\Controllers;

use App\Models\DoorAdditionalParam;
use Illuminate\Http\Request;
use App\Http\Resources\DoorAdditionalParam as DoorAdditionalParamResource;

class DoorAdditionalParamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return DoorAdditionalParamResource::collection(DoorAdditionalParam::get());
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
        //
        $param = !empty($request->input('id')) ? Parameter::findOrFail($request->input('id')) : new Parameter;
        $param->title = $request->input('title');
        $param->title_en = $request->input('title_en');
        $param->price = $request->input('price');
        $param->parameter_type_id = $request->input('parameter_type_id');
        $param->door_type_id = $request->input('door_type_id');
        $param->save();
        return new ParameterResource($param);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DoorAdditionalParam  $doorAdditionalParam
     * @return \Illuminate\Http\Response
     */
    public function show(DoorAdditionalParam $doorAdditionalParam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DoorAdditionalParam  $doorAdditionalParam
     * @return \Illuminate\Http\Response
     */
    public function edit(DoorAdditionalParam $doorAdditionalParam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DoorAdditionalParam  $doorAdditionalParam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoorAdditionalParam $doorAdditionalParam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DoorAdditionalParam  $doorAdditionalParam
     * @return \Illuminate\Http\Response
     */
    public function destroy($doorAdditionalParam)
    {
        //
        DoorAdditionalParam::find($doorAdditionalParam)->delete();
        return DoorAdditionalParamResource::collection(DoorAdditionalParam::get());
    }
}
