<?php

namespace App\Http\Controllers;

use App\Models\AdditionalParamType;
use Illuminate\Http\Request;
use App\Http\Resources\AdditionalParamType as AdditionalParamTypeResource;

class AdditionalParamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return AdditionalParamTypeResource::collection(AdditionalParamType::get());
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
        $param = !empty($request->input('id')) ? AdditionalParamType::findOrFail($request->input('id')) : new AdditionalParamType;
        $param->title = $request->input('title');
        $param->title_en = $request->input('title_en');
        $param->save();
        return new AdditionalParamTypeResource($param);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdditionalParamType  $additionalParamType
     * @return \Illuminate\Http\Response
     */
    public function show(AdditionalParamType $additionalParamType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdditionalParamType  $additionalParamType
     * @return \Illuminate\Http\Response
     */
    public function edit(AdditionalParamType $additionalParamType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdditionalParamType  $additionalParamType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdditionalParamType $additionalParamType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdditionalParamType  $additionalParamType
     * @return \Illuminate\Http\Response
     */
    public function destroy($additionalParamType)
    {
        //
        AdditionalParamType::find($additionalParamType)->delete();
        return AdditionalParamTypeResource::collection(AdditionalParamType::get());
    }
}
