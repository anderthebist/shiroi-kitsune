<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studio;
use App\Http\Requests\StudioCreateRequest;
use App\Http\Requests\StudioUpdateRequest;

class StudiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studios = Studio:: orderBy('created_at','desc')->paginate(25);
        return view("admin.studio.index", [
            "studios" => $studios
        ]);
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
    public function store(StudioCreateRequest $request)
    {
        $this->authorize('admin', User::class);
        $studio = Studio:: create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $studio = Studio:: where('id', $id)->first();
        return view("admin.studio.edit", [
            "studio" => $studio
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudioUpdateRequest $request, $id)
    {
        $this->authorize('admin', User::class);
        $studio = Studio:: where('id', $id)->first();
        $studio->update($request->all());
        return redirect()->route("studios.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('admin', User::class);
        $studio = Studio::where('id',$id)->delete();
        return redirect()->back();
    }
}
