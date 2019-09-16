<?php

namespace App;

class Thread
{
    public $withUser;
    public $thread;

    public function __construct($user, $message) {
        $this->withUser = $user;
        $this->thread = $message;
    }
}