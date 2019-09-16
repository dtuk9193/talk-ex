<?php

namespace App;

class Sender
{
    public $name;
    public $url;
    public $id;

    public function __construct($Id, $name_v, $url_v){
        $this->id = $Id;
        $this->name = $name_v;
        $this->url = $url_v;
    }
}