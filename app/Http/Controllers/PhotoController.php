<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Resources\Photo as PhotoResource;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return PhotoResource::collection(Photo::get());
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
       if($request->file()) {
        $file_name = time().'_'.$request->file->getClientOriginalName();
        $file_path = $request->file('file')->storeAs('', $file_name, 'public');

        $param = !empty($request->input('id')) ? Photo::findOrFail($request->input('id')) : new Photo;
        $param->door_type = $request->input('door_type');
        $param->panel = $request->input('panel');

        $param->name = time().'_'.$request->file->getClientOriginalName(); //failo pavadinimas
        $param->path = '/images/' . $file_path; //failo kelias
        $request->file->move(public_path('/images'),$file_name);
        // $image->move('img', $file_name);
        $param->save();
        return new PhotoResource($param);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy($photo)
    {
        //
        Photo::find($photo)->delete();
        return PhotoResource::collection(Photo::get());
    }
}
