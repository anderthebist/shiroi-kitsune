<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    public function create(User $user, User $checkUser) {
        return $user->id === $checkUser->id;
    }
}
