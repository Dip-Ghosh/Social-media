<?php

namespace App\Strategy\LoginStrategy;
use App\Strategy\LoginStrategy\LoginStrategy;
use Laravel\Socialite\Facades\Socialite;

class GithubLogin  implements  LoginStrategy{

    public function getSoicalMedia($data){
        return Socialite::driver($data)->user();
    }
}
