<?php

namespace App\Services;

use App\Models\Mark;
use App\Models\Anime;

class MarkService {
    
    public function create($markData) {
        $newMark = Mark:: create([
            'mark'=> $markData->mark,
            'anime_id'=> $markData->anime_id,
            'user_id'=> auth()->user()->id
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

    public function isMark($id) {
        $isMark = true;
        if(auth()->user()) {
            $isMark = auth()->user()->markes()->where('anime_id', $id)->first();
        }

        return !!$isMark;
    }
}