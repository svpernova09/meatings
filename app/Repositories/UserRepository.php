<?php

namespace Meatings\Repositories;

use Meatings\User;

class UserRepository {

    public function findByUsernameOrCreate($userData, $code)
    {
        $user = User::firstOrCreate([
            'name' => $userData->getName(),
            'email' => $userData->getEmail(),
            'avatar' => $userData->getAvatar(),
        ]);

        $user->token = $userData->token;
        $user->code = $code;
        $user->save();

        return $user;
    }
}