<?php

namespace App\Services;

use App\Models\Voice;

class VoiceService {

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
}