<?php

namespace App;

use App\User;

class Auth
{
    static function user() {
        $user = new User();
        return $user;
    }
}