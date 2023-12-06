<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassword;
use App\Models\social_accounts as ModelsSocial_accounts;
use App\Models\User;
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
use Illuminate\Support\Facades\Hash;
use Psy\Readline\Hoa\Console;

class UserController extends Controller
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


    
    public function profile()
    {
        $user = $this->getCurrentLoggedIn();

        if (!isset($user)) {
            return response()->json([
                'message' => 'not found login '
            ], 500);
        }

        return response()->json([
            'data' => $user
        ], 200);
    }
    
    public function get(Request $request){
        $user=$this->getCurrentLoggedIn();
        $search = $request->input('search');
        $users= $this->userService->get($search,$user);
        return response()->json([
            $users
        ]);
    }

    public function getById($id)
    {
        $user = $this->userService->getById($id);

        if ($user === null) {
            return response()->json([
                'status' =>  false,
                'message' => 'user_id not found',
            ], 404);
        }

        return response()->json([
            'data' => $user
        ], 202);
    }

    public function update($id, Request $userequest)
    {
        $user = $this->userService->getById($id);
        if($user->role_id > 2){
            $this->userService->edit($id, $userequest->except(['avatar','role_id','branch_id']));
        }
        else{
            $this->userService->edit($id, $userequest->except(['avatar']));
        }
        return response()->json([
            'status' => true,
            'message' => 'update successful'
        ], 200);
    }

    public function updateAvatar($id, Request $request)
    {
        if ($request->file('image_data')) {
            $avatar = $request->file('image_data');
            $this->userService->editAvatar($id,$avatar);
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật avatar thành công'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Không có tệp avatar được tải lên'
            ], 400);
        }
    }

    public function deactive($id)
    {
        $user = $this->userService->deActive($id);
        if ($user === null) {
            return response()->json([
                "message" => "user not found",
            ], 404);
        }
        return response()->json([$user], 202);
    }

    // active
    public function active($id)
    {
        $user = $this->userService->active($id);
        if ($user === false) {
            return response()->json([
                "message" => "user not found",
            ], 404);
        }
        return response()->json([$user], 202);
    }

    public function changePassword(ChangePassword $request)
    {
        $email = $request->email;
        $users=$this->getCurrentLoggedIn();
        $user = $this->userService->getByEmail($email);
        if ($user === null) {
            return response()->json([
                'status' => false,
                'message' => 'email not found!',
            ], 404);
        }
        if($users){
            if($users->email !== $email ){
                return response()->json([
                    'status' => false,
                    'message' => 'Email không chính xác!',
                ], 404);
            }
            if (!Hash::check($request->old_password, $users->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Mật khẩu cũ không chính xác!',
                ], 404);
            }
            $this->userService->newPassword($users->email, $request->new_password);

            return response()->json([
                'status' => true,
                'message' => 'change password successful!',
            ], 200);
        }
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Mật khẩu cũ không chính xác!',
            ], 404);
        }

        $this->userService->newPassword($user->email, $request->new_password);
        return response()->json([
            'status' => true,
            'message' => 'Thay đổi mật khẩu thành công!',
        ], 200);
    }
}
