<?php

namespace App;

use Illuminate\Support\Facades\View;
use App\Thread;

class Talk
{
    public $thread;
    static function setAuthUserId() {

    }

    static function threads() {
        
    }
    public function __construct($thread){
        $this->thread = $thread;
    }
}