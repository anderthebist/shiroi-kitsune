<?php

namespace App\Services;

use App\Models\Anime;
use App\Services\ImageService;
use App\Http\Requests\AnimeCreateRequest;
use App\Http\Requests\AnimeUpdateRequest;

class AnimeService {
    public $imagesPath = 'images/animes';

    private function filterData($data) {
        $all = $data->except(['image', 'poster', 'logo','license', 'categories', 'voices']);

        $all['license'] = $data->has('license');
        $all['original_title'] = str_replace(' ', '_', $data["original_title"]);

        return $all;
    }

    public function create(AnimeCreateRequest $request) {
        $all = $this->filterData($request);
        $imageService = new ImageService();
        
        foreach($request->files as $key => $file) {
            $all[$key] = $imageService->upload($file, $this->imagesPath);
        }
        $anime = Anime:: create($all);

        $anime->categories()->attach($request->categories);
        $anime->voices()->attach($request->voices);

        return $anime;
    }

    public function update(AnimeUpdateRequest $request, $id) {
        $all = $this->filterData($request);
        $anime = Anime:: where('id', $id)->first();
        
        $imageService = new ImageService();
        foreach($request->files as $key => $file) {
            if($anime[$key]) {
                $imageService->delete($this->imagesPath."/".$anime[$key]);
            }
            $all[$key] = $imageService->upload($file, $this->imagesPath);
        }

        $anime->update($all);

        $anime->categories()->sync($request->categories);
        $anime->voices()->sync($request->voices);

        return $anime;
    }

    public function delete($id) {
        $anime = Anime::where('id',$id)->first();

        $imageService = new ImageService();
        $images = [$anime->image, $anime->poster, $anime->logo];

        foreach($images as $image) {
            $imageService->delete($this->imagesPath.'/'.$image);
        }
        $anime->delete();
    }

    public function search($title = "") {
        return Anime:: query()->where('title', 'LIKE', "%{$title}%")->orWhere('original_title', 'LIKE', "%{$title}%");
    }
}