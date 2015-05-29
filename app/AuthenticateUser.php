<?php

namespace Meatings;

use Laravel\Socialite\Contracts\Factory as Socialite;
use Illuminate\Contracts\Auth\Guard;
use Meatings\Repositories\UserRepository;

class AuthenticateUser {

    private $users;
    private $socialite;
    private $auth;

    public function __construct(UserRepository $users, Socialite $socialite, Guard $auth)
    {
        $this->users = $users;
        $this->socialite = $socialite;
        $this->auth = $auth;
    }

    public function execute($hasCode, $listener)
    {
        if (!$hasCode) return $this->getAuthorizationFirst();

        $user = $this->users->findByUsernameOrCreate($this->getGoogleUser());

        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    private function getAuthorizationFirst()
    {

//        return $this->socialite->with('google')->scopes(['https://www.googleapis.com/auth/calendar'])->redirect();
        return $this->socialite->with('google')->redirect();

    }

    private function getGoogleUser()
    {

        return $this->socialite->with('google')->user();
    }
}