<?php

namespace App\Http\Controllers;

use App\Models\Decoration;
use Illuminate\Http\Request;
use App\Http\Resources\Decoration as DecorationResource;

class DecorationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return DecorationResource::collection(Decoration::get());
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
        $param = !empty($request->input('id')) ? Decoration::findOrFail($request->input('id')) : new Decoration;
        $param->title = $request->input('title');
        $param->title_en = $request->input('title_en');
        $param->price = $request->input('price');
        $param->panel_id = $request->input('panel_id');
        $param->save();
        return new DecorationResource($param);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Decoration  $decoration
     * @return \Illuminate\Http\Response
     */
    public function show(Decoration $decoration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Decoration  $decoration
     * @return \Illuminate\Http\Response
     */
    public function edit(Decoration $decoration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Decoration  $decoration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Decoration $decoration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Decoration  $decoration
     * @return \Illuminate\Http\Response
     */
    public function destroy($decoration)
    {
        //
        Decoration::find($decoration)->delete();
        return DecorationResource::collection(Decoration::get());
    }
}
