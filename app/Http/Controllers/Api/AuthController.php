<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\social_accounts as ModelsSocial_accounts;
use App\Models\User;
use App\Services\AuthServices;
use App\Services\SocialService;
use App\Services\UserService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    /**
     * @var AuthServices
     */
    protected $authService;
    /**
     * @var UserService
     */
    protected $userService;
     /**
     * @var SocialService
     */
    protected $socialService;
    public function __construct(
        
        AuthServices $authService,
        UserService $userService,
        SocialService $socialService
        )
    {   
        $this->authService = $authService;
        $this->userService = $userService;
        $this->socialService = $socialService;
    }

    public function googleLoginUrl()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $check = $this->authService->check($googleUser->email);
            if (!$check) {
                $user=$this->userService->create($googleUser);
                $this->socialService->create($googleUser,$user);
            }
            if (Auth::attempt(['email'=> $googleUser->email, 'password'=>'123456'])) {
                $user=$this->userService->getByEmail($googleUser->getEmail());
                $token=$user->createToken('authToken')->plainTextToken;
                $cookies= cookie::make('api_token',$token,60*24);
                return  redirect()->intended('/home')->withCookie($cookies);
            }
             return  redirect()->intended('/login');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
