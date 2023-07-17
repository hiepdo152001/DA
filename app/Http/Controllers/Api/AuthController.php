<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\social_accounts as ModelsSocial_accounts;
use App\Models\User;
use App\Services\AuthServices;
use Exception;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    /**
     * @var AuthServices
     */
    protected $authServices;
    public function __construct(AuthServices $authServices)
    {
        $this->authServices = $authServices;
    }

    //register
    public function googleLoginUrl()
    {

        return Socialite::driver('google')->redirect();
    }



    public function loginCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $check = $this->authServices->check($googleUser->id);
            if (!$check) {
                $user = User::create([
                    'email' => $googleUser->email,
                    'name' => $googleUser->name,
                    'password' => '1234'
                ]);
                $token = $user->createToken('api_token')->plainTextToken;
                ModelsSocial_accounts::create(
                    [
                        'social_id' => $googleUser->id,
                        'social_name' => $googleUser->name,
                        'social_provider' => 'google',
                        'user_id' => $user->id
                    ],
                );
                return redirect()->intended('/home')->cookie('api_token',  $token, 60 * 24);
            }
            return redirect()->intended('/home')->cookie('api_token',  "123", 60 * 24);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

    //getme