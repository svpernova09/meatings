<?php

namespace Meatings;

use Laravel\Socialite\Contracts\Factory as Socialite;
use Illuminate\Contracts\Auth\Guard;
use Meatings\Repositories\UserRepository;
use Google_Client;

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
//    dd($_REQUEST);
        if (!$hasCode) return $this->getAuthorizationFirst();

        $code = $_REQUEST['code'];
        $user = $this->users->findByUsernameOrCreate($this->getGoogleUser(), $code);

        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    private function getAuthorizationFirst()
    {
        $scopes = [
            'https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/plus.login',
            'https://www.googleapis.com/auth/plus.profile.emails.read',
            'https://www.googleapis.com/auth/calendar',
        ];

        return $this->socialite->with('google')->scopes($scopes)->redirect();
//        return $this->socialite->with('google')->redirect();


//        $client = new Google_Client();
//        $client->setClientId(env('GOOGLE_CLIENT_ID'));
//        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
//        $client->setRedirectUri(env('GOOGLE_CALLBACK_URL'));
    }

    private function getGoogleUser()
    {

        return $this->socialite->with('google')->scopes(['https://www.googleapis.com/auth/calendar'])->user();
    }
}