<?php

namespace App\Http\Controllers;

use App\Models\Pattern;
use Illuminate\Http\Request;
use App\Http\Resources\Pattern as PatternResource;

class PatternController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return PatternResource::collection(Pattern::get());
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
        $param = !empty($request->input('id')) ? Pattern::findOrFail($request->input('id')) : new Pattern;
        $param->title = $request->input('title');
        $param->title_en = $request->input('title_en');
        $param->photo = $request->input('photo');
        $param->panel_id = $request->input('panel_id');
        $param->save();
        return new PatternResource($param);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pattern  $pattern
     * @return \Illuminate\Http\Response
     */
    public function show(Pattern $pattern)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pattern  $pattern
     * @return \Illuminate\Http\Response
     */
    public function edit(Pattern $pattern)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pattern  $pattern
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pattern $pattern)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pattern  $pattern
     * @return \Illuminate\Http\Response
     */
    public function destroy($pattern)
    {
        //
        Pattern::find($pattern)->delete();
        return PatternResource::collection(Pattern::get());
    }
}
