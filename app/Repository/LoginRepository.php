<?php

namespace App\Repository;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Events\PostLoginEmail;

class LoginRepository
{

    public function ServiceName($service)
    {
        return Socialite::driver($service)
            ->stateless()
            ->user();
    }

    public function findUser($user)
    {
        return User::where('social_network_id', $user->id)->first();
    }

    public function create($user, $service)
    {
        return User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'social_network_id' => $user['id'],
            'social_network_name' => $service,
            'password' => encrypt('123456dummy')
        ]);
    }

    public function login($credentials)
    {
         Auth::login($credentials);
        $this->emailSendEvent($credentials);
    }

    public function emailSendEvent($newUser){
        event(new PostLoginEmail($newUser));
    }


}
