<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use mysql_xdevapi\Exception;
use App\Repository\LoginRepository;
use App\Strategy\SendMessage;
use App\Strategy\EmailNotifcation;


class SocialLoginController extends Controller
{
    protected $loginRepository ;
    private $sendMessage ;

    public function __construct(SendMessage $sendMessage)
    {
        $this->sendMessage = $sendMessage;
    }
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
                $newUser = Auth::user();
                $this->sendMessage->notification(new EmailNotifcation($newUser));
            }
            else{

                $newUser = $loginRepository->create($user,$service);
                $loginRepository->login($newUser);
                $this->sendMessage->notification(new EmailNotifcation($newUser));
            }
            return redirect()->intended('dashboard');

        } catch (Exception $e) {
           throw  new Exception($e->getMessage());
        }
    }





}
