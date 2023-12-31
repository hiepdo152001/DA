<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\social_accounts as ModelsSocial_accounts;
use App\Models\User;
use App\Notifications\RegisterNotify;
use App\Services\AuthServices;
use App\Services\SocialService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
            $user=$this->userService->getByEmail($googleUser->getEmail());
            if (!$check) {
                $user=$this->userService->create($googleUser);
                $this->socialService->create($googleUser,$user);
            }
            if($user-> status === 1){
                return  redirect()->intended('/login');
            }
            if (Auth::attempt(['email'=> $googleUser->email, 'password'=>'Aa123@#@#@***'])) {
                $user->tokens()->delete();
                $token=$user->createToken('authToken')->plainTextToken;
                $cookies= cookie::make('api_token',$token,60*24);
                return  redirect()->intended('/home')->withCookie($cookies);
            }
            return redirect()->back();
        } catch (Exception $e) {
                        return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $user = $this->userService->getByEmail($email);
        if (!$user) {
            return response()->json([
                'message' => 'Tài khoản hoặc mật khẩu không chính xác!',
                'status' => false
            ], 401);
        }
        if ($user->status === 1) {
            return response()->json([
                'message' => 'Tài khoản đã bị đóng băng!',
            ], 500);
        }
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Mật khẩu không chính xác',
                'status' => false
            ], 401);
        }
        $user->tokens()->delete();
        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json([
            'message' => 'login successful',
            'status' => true,
            'token' => $token
        ], 200)->cookie('api_token',  $token, 60 * 24);
    }
    
    public function logout(){
        try {
            Auth::logout();
            $cookie = cookie()->forget('api_token');
            return redirect()->intended('/login')->withCookie($cookie);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function register(RegisterRequest $request)
    {   
        $user = $this->userService->register($request->all());
        $user->notify(new RegisterNotify($user));

        return response()->json([
            'status' =>  true,
            'message' => 'User Create Successfully',
        ], 200);
    }

    public function pass(Request $request)
    {   
        $user = $this->userService->pass($request->all());
        if(!$user){
            return response()->json([
                'status' =>  true,
                'message' => 'Email hoặc số điện thoại không hợp lệ',
            ], 404);
        }
        return response()->json([
            'status' =>  true,
            'message' => 'User Create Successfully',
        ], 200);
    }
}
