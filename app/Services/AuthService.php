<?php

namespace App\Services;

use App\Models\User;
use App\Events\ForgetEvent;

class AuthService {
    public function login($userData = []) {
        $user = User:: create([
            "name" => $userData->name,
            "email" => $userData->email,
            "password" => bcrypt($userData->password)
        ]);

        if($user) {
            auth('web')->login($user);
        }

        return $user;
    }

    public function changeForgotToken($email) {
        $token = md5(uniqid());
        $password = User:: where("email", $email)->update(['token' => $token]);

        event(new ForgetEvent($email, $token));

        return $token;
    }

    public function reset($token, $password) {
        $user = User:: where("token", $token)->first();
        $user->password = bcrypt($password);
        $user->token = null;
        $user->save();
    }
}