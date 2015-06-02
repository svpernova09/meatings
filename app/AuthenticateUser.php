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
    private $scopes;

    public function __construct(UserRepository $users, Socialite $socialite, Guard $auth)
    {
        $this->users = $users;
        $this->socialite = $socialite;
        $this->auth = $auth;
        $this->scopes =
            'https://www.googleapis.com/auth/plus.me ' .
            'https://www.googleapis.com/auth/plus.login ' .
            'https://www.googleapis.com/auth/plus.profile.emails.read ' .
            'https://www.googleapis.com/auth/calendar';
    }

    public function execute($hasCode, $listener)
    {
//    dd($_REQUEST);
        if (!$hasCode) return $this->getAuthorizationFirst();

        $code = $_REQUEST['code'];

        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_CALLBACK_URL'));

        $client->authenticate($code);
        $_SESSION['access_token'] = $client->getAccessToken();
        $client->setScopes($this->scopes);

        $plus = new \Google_Service_Plus($client);
        $person = $plus->people->get('me');

        $user = $this->users->findByUsernameOrCreate($person, $code);
        $this->auth->login($user, true);

        return redirect('home');
    }

    private function getAuthorizationFirst()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_CALLBACK_URL'));
        $client->setScopes($this->scopes);

        $authUrl = $client->createAuthUrl();
        header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));

//        return $this->socialite->with('google')->scopes($scopes)->redirect();

    }

    private function getGoogleUser()
    {
//        return $this->socialite->with('google')->scopes(['https://www.googleapis.com/auth/calendar'])->user();
    }
}