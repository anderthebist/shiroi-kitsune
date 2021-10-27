<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Services\NewsService;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = 6;
        $news = News:: orderBy('created_at','desc')->paginate($count);

        return view("news", [
            "news" => $news
        ]);
    }

    public function admin() {
        $count = 12;
        $news = News:: orderBy('created_at','desc')->paginate($count);

        return view("admin.news.index", [
            "news" => $news
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.news.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsCreateRequest $request, NewsService $newService)
    {
        $this->authorize('admin', User::class);
        $news = $newService->create($request);
        return redirect()->route('news.show', ['news'=> $news]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News:: where('id', $id)->first();

        return view("news_show", [
            'news' => $news
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
        $news = News:: where('id', $id)->first();

        return view('admin.news.edit', [
            'news'=> $news
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsUpdateRequest $request, $id, NewsService $newService)
    {
        $this->authorize('admin', User::class);
        $news = $newService->update($request, $id);
        
        return view("news_show", [
            'news' => $news
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, NewsService $newService)
    {
        $this->authorize('admin', User::class);
        $newService->delete($id);
        return redirect()->back();
    }
}
