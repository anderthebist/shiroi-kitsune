<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    public function update(User $user, User $checkUser) {
        return $user->id === $checkUser->id;
    }

    public function admin(User $user) {
        return $user->status === "админ";
    }
}
