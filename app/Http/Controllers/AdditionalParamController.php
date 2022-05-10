<?php

namespace App\Http\Controllers;

use App\Models\AdditionalParam;
use Illuminate\Http\Request;
use App\Http\Resources\AdditionalParam as AdditionalParamResource;

class AdditionalParamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return AdditionalParamResource::collection(AdditionalParam::get());
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
        $param = !empty($request->input('id')) ? AdditionalParam::findOrFail($request->input('id')) : new AdditionalParam;
        $param->title = $request->input('title');
        $param->title_en = $request->input('title_en');
        $param->glass_packet = $request->input('glass_packet');
        $param->price = $request->input('price');
        $param->additional_param_type_id = $request->input('additional_param_type_id');
        $param->panel_id = $request->input('panel_id');
        $param->save();
        return new AdditionalParamResource($param);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdditionalParam  $additionalParam
     * @return \Illuminate\Http\Response
     */
    public function show(AdditionalParam $additionalParam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdditionalParam  $additionalParam
     * @return \Illuminate\Http\Response
     */
    public function edit(AdditionalParam $additionalParam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdditionalParam  $additionalParam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdditionalParam $additionalParam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdditionalParam  $additionalParam
     * @return \Illuminate\Http\Response
     */
    public function destroy($additionalParam)
    {
        //
        AdditionalParam::find($additionalParam)->delete();
        return AdditionalParamResource::collection(AdditionalParam::get());
    }
}
