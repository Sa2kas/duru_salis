<?php

namespace App\Http\Controllers;

use App\Models\DoorType;
use Illuminate\Http\Request;
use App\Http\Resources\DoorType as DoorTypeResource;

class DoorTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return DoorTypeResource::collection(DoorType::get());
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
        $param = !empty($request->input('id')) ? DoorType::findOrFail($request->input('id')) : new DoorType;
        $param->title = $request->input('title');
        $param->title_en = $request->input('title_en');
        $param->save();
        return new DoorTypeResource($param);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DoorType  $doorType
     * @return \Illuminate\Http\Response
     */
    public function show(DoorType $doorType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DoorType  $doorType
     * @return \Illuminate\Http\Response
     */
    public function edit(DoorType $doorType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DoorType  $doorType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoorType $doorType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DoorType  $doorType
     * @return \Illuminate\Http\Response
     */
    public function destroy($doorType)
    {
        //
        DoorType::find($doorType)->delete();
        return DoorTypeResource::collection(DoorType::get());
    }
}
