<?php

namespace App\Repository;

use App\Strategy\LoginStrategy\FacebookLogin;
use App\Strategy\LoginStrategy\GithubLogin;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class LoginRepository
{


    public function ServiceName($service)
    {
        switch ($service){
            case 'facebook':
                $object = new FacebookLogin();
                break;
            case 'github':
                $object = new GithubLogin();
                break;
            case 'google':
                $object = new FacebookLogin();
                break;

        }
        return  $object->getSoicalMedia($service);

    }

    public function findUser($user)
    {
        if(!empty($user)){
            return User::where('social_network_id', $user->id)->first();
        }

    }

    public function create($user, $service)
    {
        $test = $service;
        return User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'social_network_id' => $user['id'],
            'social_network_name' => $test,
            'password' => encrypt('123456dummy')
        ]);
    }

    public function login($credentials)
    {
         Auth::login($credentials);
    }




}
