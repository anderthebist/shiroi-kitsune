<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Mark;

class MarkPolicy
{
    public function create(User $user, $anime_id) {
        return $user;
    }

    public function isset_mark(User $user, $anime_id) {
        return $user->markes->pluck('anime_id')->contains($anime_id);
    }
}
