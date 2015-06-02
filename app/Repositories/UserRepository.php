<?php

namespace Meatings\Repositories;

use Meatings\User;

class UserRepository {

    public function findByUsernameOrCreate($userData, $code)
    {
        $user = User::firstOrCreate([
            'name' => $userData->getDisplayName(),
            'email' => $userData->getEmails()['0']['value'],
            'avatar' => $userData->getImage()->url,
        ]);

        $user->token = $_SESSION['access_token'];
        $user->code = $code;
        $user->save();

        return $user;
    }
}