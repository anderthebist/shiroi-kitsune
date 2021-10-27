<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Models\Anime;
use App\Models\Category;
use App\Models\Voice;
use App\Models\Studio;
use App\Models\User;
use App\Services\MarkService;
use App\Services\AnimeService;
use App\Http\Filters\AnimeFilter;
use App\Http\Requests\AnimeCreateRequest;
use App\Http\Requests\AnimeUpdateRequest;
use App\Services\ImageService;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AnimeFilter $request)
    {
        $new_serias = Anime:: filter($request)->orderBy('created_at','desc')->paginate(6);
        $categories = Category:: orderBy('name')->get();
        $studios = Studio:: orderBy('name')->get();

        return view("anime", [
            "categories" => $categories,
            "studios"=> $studios,
            "new_serias" => $new_serias
        ]);
    }

    public function admin(Request $request) {
        $relizes = Anime:: orderBy('created_at','desc')->paginate(8);

        return view("admin.anime.index", [
            "relizes" => $relizes
        ]);
    }

    public function search(SearchRequest $request, AnimeService $animeService) {
        $relizes = $animeService->search($request->value)->take(4)->get();
        return response()->json(["resultCode"=> 0,'relizes' => $relizes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category:: orderBy('name')->get();
        $voices = Voice:: orderBy('name')->get();
        $studios = Studio:: orderBy('name')->get();
        
        return view("admin.anime.create", [
            "categories" => $categories,
            "voices"=> $voices,
            "studios"=> $studios,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimeCreateRequest $request, AnimeService $animeService)
    {
        $this->authorize('admin', User::class);
        $anime = $animeService->create($request);

        return redirect()->route('relizes.show', ['relize'=> $anime->original_title]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name, MarkService $markService)
    {
        $relize = Anime:: where('original_title', $name)->first();
        if(!$relize) return abort(404);

        return view("relize_show", [
            "relize" => $relize
        ]);
    }

    public function watch($name) {
        $relize = Anime:: where(["original_title"=> $name])->first();
        $videos = $relize->videos;
        if(!$relize || ((count($videos) === 0) && !$relize->trailer)) return abort(404);
        $comments = $relize->comments()->whereNull('parent_id')->get();

        return view('watch', [
            "relize"=> $relize,
            "videos"=> $videos,
            "comments"=> $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $relize = Anime:: where('id', $id)->first();
        $categories = Category:: orderBy('name')->get();
        $voices = Voice:: orderBy('name')->get();
        $studios = Studio:: orderBy('name')->get();
        
        return view("admin.anime.edit", [
            "relize" => $relize,
            "categories" => $categories,
            "voices"=> $voices,
            "studios"=> $studios,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnimeUpdateRequest $request, $id, AnimeService $animeService)
    {
        $this->authorize('admin', User::class);
        $updating = $animeService->update($request, $id);

        return redirect()->route('relizes.show', ['relize'=> $updating->original_title]);
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, AnimeService $animeService)
    {
        $this->authorize('admin', User::class);
        $animeService->delete($id);
        return redirect()->back();
    }
}
