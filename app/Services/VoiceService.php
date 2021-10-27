<?php

namespace App\Services;

use App\Models\Voice;
use App\Http\Requests\TeamCreateRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Services\ImageService;

class VoiceService {
    public $imagesPath = 'images/voicers';

    public function both(Voice $voice, $count = 1) {
        $half = $count / 2;
        $count_next = $count%2 == 1 ? (int) ceil($half) : ($half + 1);

        $next = Voice:: where('name', '>=', $voice->name)->oldest('name')->take($count_next)->get();
        $prev = Voice:: where('name', '<', $voice->name)->latest('name')->take($count - $count_next)->get()->reverse();
        return $prev->merge($next);
    }
    
    public function next(Voice $voice, $count = 1) {
        return Voice:: where('name', '>', $voice->name)->oldest('name')->take($count)->get();
    }

    public function prev(Voice $voice, $count = 1) {
        return Voice:: where('name', '<', $voice->name)->latest('name')->take($count)->get();
    }

    public function create(TeamCreateRequest $request) {
        $data = $request->all();
        if($request->image) {
            $imageService = new ImageService();
            $data['image'] = $imageService->upload($request->image, $this->imagesPath);
        }

        $voice = Voice:: create($data);
        return $voice;
    }

    public function update(TeamUpdateRequest $request, $id) {
        $voice = Voice:: where('id', $id)->first();
        $data = $request->all();

        if($request->image) {
            $imageService = new ImageService();
            $imageService->delete($this->imagesPath."/".$voice->image);
            $data['image'] = $imageService->upload($request->image, $this->imagesPath);
        }

        $voice->update($data);
        return $voice;
    }

    public function delete($id) {
        $voice = Voice:: where('id', $id)->first();
        $imageService = new ImageService();
        if($voice->image)
            $imageService->delete($this->imagesPath."/".$voice->image);

        $voice->delete();
    }
}