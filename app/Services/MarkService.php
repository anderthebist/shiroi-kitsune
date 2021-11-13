<?php

namespace App\Services;

use App\Models\Mark;
use App\Models\Anime;
use Illuminate\Support\Facades\Gate;

class MarkService {
    
    public function create($markData) {
        $user_id = auth()->user()->id;

        $mark = Mark:: where(["anime_id"=> $markData->anime_id, "user_id"=> $user_id ])->delete();
        $newMark = Mark:: create([
            'mark'=> $markData->mark,
            'anime_id'=> $markData->anime_id,
            'user_id'=> $user_id
        ]);

        $marks = Mark:: where('anime_id', $markData->anime_id)->get();
        $animeMark = 0;

        foreach($marks as $mark) {
            $animeMark += $mark->mark;
        }
        $animeMark = round($animeMark / count($marks), 1);

        $setMark = Anime:: whereId($markData->anime_id)->update(['mark'=> $animeMark]);
        return $animeMark;
    }

    public function get_user_mark($anime_id) {
        if(!Gate::allows('isset_mark', [App\Models\Mark::class, $anime_id])) return null;
        $mark = Mark:: where(["anime_id"=> $anime_id, "user_id"=> auth()->user()->id ])->first();

        return $mark;
    }

    public function isMark($id) {
        $isMark = true;
        if(auth()->user()) {
            $isMark = auth()->user()->markes()->where('anime_id', $id)->first();
        }

        return !!$isMark;
    }
}