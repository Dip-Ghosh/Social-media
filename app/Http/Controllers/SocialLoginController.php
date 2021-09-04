<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use mysql_xdevapi\Exception;
use App\Repository\LoginRepository;
class SocialLoginController extends Controller
{
    protected $loginRepository ;
    public function redirectToGoogle($service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback($service,LoginRepository $loginRepository)
    {
        try {

            $user = $loginRepository->ServiceName($service);
            $finduser = $loginRepository->findUser($user);

            if($finduser){
               $loginRepository->login($finduser);
               return redirect()->intended('dashboard');
            }
            else{
                $newUser = $loginRepository->create($user,$service);
                $loginRepository->login($newUser);

                return redirect()->intended('dashboard');
            }

        } catch (Exception $e) {
           throw  new Exception($e->getMessage());
        }
    }

}
