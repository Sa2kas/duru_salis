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
        $param = !empty($request->input('id')) ? Door::findOrFail($request->input('id')) : new Door;
        $param->length = $request->input('length');
        $param->width = $request->input('width');
        $param->left = $request->input('left');
        $param->door_type_id = $request->input('door_type_id');
        $param->panel_id = $request->input('panel_id');
        $param->decoration_id = $request->input('decoration_id');
        $param->main_lock = $request->input('main_lock');
        $param->safe_lock = $request->input('safe_lock');
        $param->installation = $request->input('installation');
        $param->pattern_id = $request->input('pattern_id');
        $param->color_id = $request->input('color_id');
        $param->quantity = $request->input('quantity');
        $param->price = $request->input('price');
        $param->order_id = $request->input('order_id');
        $param->save();
        return new DoorResource($param);
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
