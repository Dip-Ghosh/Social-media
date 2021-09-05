<?php
namespace App\Strategy;
use App\Strategy\SendMessage;
use App\Events\PostLoginEmail;

class EmailNotifcation implements SendMessage{

    public function notification($data){

        event(new PostLoginEmail($data));
    }
}
