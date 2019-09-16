<?php

namespace App;

use App\Sender;

class Message
{
    public $id = 0;
    public $humans_time;
    public $sender;
    public $message = '';

    public function __construct($Id = 0)
    {
        $this->id = $Id;
    }
    public function set_message($Id, $h_t, $sender_name, $sender_url, $message_string){
        $this->id = $Id;
        $this->humans_time = $h_t;
        $this->sender = new Sender($Id, $sender_name, $sender_url);
        $this->message = $message_string;
    }
}