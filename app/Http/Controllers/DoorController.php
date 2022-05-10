<?php

namespace App\Http\Controllers;

use App\Models\Door;
use Illuminate\Http\Request;
use App\Http\Resources\Door as DoorResource;

class DoorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return DoorResource::collection(Door::get());
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
     * @param  \App\Models\Door  $door
     * @return \Illuminate\Http\Response
     */
    public function show(Door $door)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Door  $door
     * @return \Illuminate\Http\Response
     */
    public function edit(Door $door)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Door  $door
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Door $door)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Door  $door
     * @return \Illuminate\Http\Response
     */
    public function destroy($door)
    {
        //
        Door::find($door)->delete();
        return DoorResource::collection(Door::get());
    }
}
