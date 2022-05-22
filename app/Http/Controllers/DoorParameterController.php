<?php

namespace App\Http\Controllers;

use App\Models\DoorParameter;
use Illuminate\Http\Request;
use App\Http\Resources\DoorParameter as DoorParameterResource;

class DoorParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return DoorParameterResource::collection(DoorParameter::get());
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
        $param = !empty($request->input('id')) ? DoorParameter::findOrFail($request->input('id')) : new DoorParameter;
        $param->door_id = $request->input('door_id');
        $param->parameter_id = $request->input('parameter_id');
        $param->save();
        return new DoorParameterResource($param);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DoorParameter  $doorParameter
     * @return \Illuminate\Http\Response
     */
    public function show(DoorParameter $doorParameter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DoorParameter  $doorParameter
     * @return \Illuminate\Http\Response
     */
    public function edit(DoorParameter $doorParameter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DoorParameter  $doorParameter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoorParameter $doorParameter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DoorParameter  $doorParameter
     * @return \Illuminate\Http\Response
     */
    public function destroy($doorParameter)
    {
        //
        DoorParameter::find($doorParameter)->delete();
        return DoorParameterResource::collection(DoorParameter::get());
    }
}
