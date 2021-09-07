<?php

namespace App\Strategy\LoginStrategy;

use Laravel\Socialite\Facades\Socialite;

class FacebookLogin implements LoginStrategy
{
    public function getSoicalMedia($data){
        return Socialite::driver($data)->user();
    }
}
