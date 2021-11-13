<?php

namespace App\Services;

use App\Models\Anime;
use App\Models\Videos;
use App\Services\AnimeService;
use App\Http\Requests\VidoeCreateRequest;
use App\Http\Requests\VideoUpdateRequest;

class VideoService {
    public $animeService;

    function __construct() {
        $this->animeService = new AnimeService();
    }

    public function create(VidoeCreateRequest $request) {
        $video = Videos:: create($request->all());
        $this->animeService->set_last_video($request->anime_id, $video->id);

        return $video;
    }
    public function delete($id) {
        $video = Videos:: where('id', $id)->first();
        $video->delete();
        $last = Videos:: where('anime_id', $video->anime_id)->orderBy('created_at','desc')->first();

        $this->animeService->set_last_video($video->anime_id, $last ? $last->id : null);
    }
}