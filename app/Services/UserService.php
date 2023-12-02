<?php

namespace App\Services;

use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var CalendarService
     */
    protected $calendarService;

    public function __construct(User $user, CalendarService $calendarService)
    {
        $this->user = $user;
        $this->calendarService = $calendarService;
    }
    public function create($googleUser){
        $user = User::create([
            'email' => $googleUser->email,
            'name' => $googleUser->name,
            'password' => Hash::make('Aa123@#@#@***'),
            'status'=> 0,
            'role_id'=> 6,
        ]);
        if($googleUser->avatar){
            $imageData = file_get_contents($googleUser->avatar); 
            Storage::put('avatar/' . $user->id . 'avatar.jpg', $imageData);
            $user->avatar = 'http://localhost:9000/mybucket/avatar/'. $user->id . 'avatar.jpg';
            $user->save();
        }
        return $user;
        
    }

    public function register(array $payload)
    {
        $payload['password'] = Hash::make($payload['password']);
        $payload['status'] = 0;
        $payload['role_id'] = 6;

        return User::create($payload);
    }


    public function getByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }
    public function getTime($timeStart, $timeEnd)
    {
        $datetime1 = new DateTime($timeStart);

        $datetime2 = new DateTime($timeEnd);
        $dayOn = 0;
        $diff = $datetime1->diff($datetime2);

        $time = $diff->d * 24 + $diff->h + $diff->i / 60;

        $days = $diff->d;

        //cung mot ngay
        if ($days === 0) {
            if ($time < 8) {
                $dayOn += $this->calendarService->setTime($timeStart, $timeEnd);
            } else {
                $dayOn += 1;
            }
        } else {
            // qua mot ngay
            $dayOn += $days;

            $residual = $time - $days * 24;

            if ($residual > 0) {
                $time_in = new DateTime($timeStart);
                $time_out = new DateTime($timeEnd);

                $time_in->setDate($time_out->format('Y'), $time_out->format('m'), $time_out->format('d'));

                $times_in = $time_in->format('Y-m-d H:i:s.u');

                $dayOn += $this->calendarService->setTime($times_in, $timeEnd);
            }
        }
        return $dayOn;
    }

    public function get($search,$user){
        if (!empty($search)) {
            if($user->branch_id == null){
                $user = User::where(function ($query) use ($search) {
                    $query->where('id', $search)
                        ->orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                })
                ->paginate(3);
            }
            else{
                $user = User::where('branch_id', $user->branch_id)
                ->where(function ($query) use ($search) {
                    $query->where('id', $search)
                        ->orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                })->paginate(3);
            }
        }else{
            if($user-> branch_id === null ){
                $user = User::paginate(3);
            }
            else{
            $user = User::where('branch_id', $user->branch_id)->paginate(3);
            }
        }
        return $user;   
       
    }

    public function getManager($branch_id)
    {
        $user = User::where('branch_id', $branch_id)
            ->where('role_id', 2)
            ->first();
        return $user;
    }

    public function getById($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function editAvatar($id,$avatar){
        $user = $this->getById($id);
            if (Storage::exists('avatar/' . $id . 'avatar.jpg')) {
                Storage::delete('avatar/' . $id . 'avatar.jpg');
            }
            Storage::putFileAs('avatar', $avatar, $id. 'avatar.jpg');

            $user->avatar = 'http://localhost:9000/mybucket/avatar/' . $id . 'avatar.jpg';
            $user->save();
       return $user;
    }

    public function edit($id, array $payload){
        $user = $this->getById($id);
        $user->update($payload);
        return $user;
    }

    public function deActive($id)
    {
        $user = User::find($id);
        if ($user === null) {
            return $user;
        }
        $user->status = 1;
        $user->save();
        return $user;
    }

    public function active($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();
        return $user;
    }
    
    public function leaveDays($id)
    {
        $user = User::find($id);
        $user->leave_days = $user->leave_days + 1;
        $user->save();
    }
    
}