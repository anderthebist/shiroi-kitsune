<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;
use App\Models\Videos;
use App\Services\VideoService;
use App\Http\Requests\VidoeCreateRequest;
use App\Http\Requests\VideoUpdateRequest;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $relizes = Anime:: orderBy('created_at','desc')->get();
        return view("admin.video.create", [
            "relizes" => $relizes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VidoeCreateRequest $request, VideoService $videoService)
    {
        $this->authorize('admin', User::class);
        $video = $videoService->create($request);

        return redirect()->route('watch', ['name'=> $video->anime->original_title]);
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
        $video = Videos:: where('id', $id)->first();

        return view("admin.video.edit", [
            'video'=> $video
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideoUpdateRequest $request, $id)
    {
        $this->authorize('admin', User::class);
        $video = Videos:: where('id', $id)->first();
        $video->update($request->all());

        return redirect()->route('watch', ['name'=> $video->anime->original_title]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, VideoService $videoService)
    {
        $this->authorize('admin', User::class);
        $videoService->delete($id);

        return redirect()->back();
    }
}
