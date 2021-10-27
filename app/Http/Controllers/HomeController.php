<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Anime;
use App\Models\News;
use App\Services\AnimeService;
use App\Models\User;

class HomeController extends Controller
{
    public function index(AnimeService $animeService) {
        $count = 6;
        $relizes = Anime:: orderBy('created_at','desc')->take(14)->get();
        $new_serias = Anime:: orderBy('last_video','desc')->take($count)->get();
        $header = Anime:: whereNotNull('poster')->orderBy('created_at','desc')->take(4)->get();

        $news = News:: orderBy('created_at','desc')->take(2)->get();

        return view("index",[
            "header" => $header,
            "relizes" => $relizes,
            "new_serias" => $new_serias,
            "news" => $news
        ]);
    }
}
