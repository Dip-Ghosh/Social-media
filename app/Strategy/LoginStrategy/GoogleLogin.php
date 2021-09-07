<?php

namespace App\Strategy\LoginStrategy;

use Laravel\Socialite\Facades\Socialite;

class GoogleLogin implements LoginStrategy
{
    public function getSoicalMedia($data){
        return Socialite::driver($data)
            ->stateless()
            ->user();
    }
}
