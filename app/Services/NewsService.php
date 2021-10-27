<?php

namespace App\Services;

use App\Models\News;
use App\Services\ImageService;
use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;

class NewsService {
    public $imagesPath = 'images/news';

    public function create(NewsCreateRequest $request) {
        $data = $request->all();
        $imageService = new ImageService();
        $data["image"] = $imageService->upload($request->image, $this->imagesPath);
        $news = News:: create($data);

        return $news;
    }

    public function delete($id) {
        $news = News:: where('id', $id)->first();
        $imageService = new ImageService();

        $imageService->delete($this->imagesPath."/".$news->image);

        $news->delete();
    }

    public function update(NewsUpdateRequest $request, $id) {
        $data = $request->all();
        $news = News:: where('id',$id)->first();

        if($request->image) {
            $imageService = new ImageService();
            $imageService->delete($this->imagesPath."/".$news->image);
            $data["image"] = $imageService->upload($request->image, $this->imagesPath);
        }

        $news->update($data);
        return $news;
    }
}