<?php

namespace Meatings\Repositories;

use Meatings\User;

class UserRepository {

    public function findByUsernameOrCreate($userData)
    {

        return User::firstOrCreate([
            'name' => $userData->name,
            'email' => $userData->email,
            'avatar' => $userData->avatar,
        ]);
    }
}