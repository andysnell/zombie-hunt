<?php

namespace App\Service;

use League\OAuth2\Client\Token\AccessToken;

class ZombieService
{
    public function getToken(): AccessToken
    {
        Tombstone::exhume();
        return new AccessToken([
            'access_token' => bin2hex(random_bytes(32)),
            'expires_in' => 3600,
        ]);
    }
}
