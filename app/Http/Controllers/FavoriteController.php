<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Http\Requests\FavotiteRequest;

class FavoriteController extends Controller
{
    public function create(FavotiteRequest $request) {
        $favorite = Favorite:: create([
            'anime_id'=> $request->anime_id,
            'user_id'=> auth()->user()->id
        ]);

        return $favorite;
    }

    public function delete(Request $request,$anime_id) {
        $favorite = Favorite:: where([
            ['anime_id', '=', $anime_id],
            ['user_id', '=', auth()->user()->id] ])->delete();

        return $favorite;
    }
}
