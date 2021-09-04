<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use mysql_xdevapi\Exception;

class SocialLoginController extends Controller
{
    public function redirectToGoogle($service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback($service)
    {
        try {

            $user = Socialite::driver($service)->stateless()->user();

            $finduser = User::where('social_network_id', $user->id)->first();

            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            }
            else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_network_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);
                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }

        } catch (Exception $e) {
           throw  new Exception($e->getMessage());
        }
    }

}
