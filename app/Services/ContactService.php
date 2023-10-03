<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\User;
use App\Notifications\RequestNotify;
use DateTime;
use Illuminate\Support\Facades\Hash;

class ContactService
{
    /**
     * Undocumented function
     *
     * @var Contact
     */
    protected $contact;
    /**
     * Undocumented function
     *
     * @var UserService
     */
    protected $userService;

    /**
     *@var CalendarService
     */
    protected $calendarService;

    public function __construct(Contact $contact, UserService $userService, CalendarService $calendarService)
    {
        $this->contact = $contact;
        $this->userService = $userService;
        $this->calendarService = $calendarService;
    }

    public function create($userId, $request)
    {
        $contact = Contact::create([
            'content'=> $request->content,
            'phone'=>$request->phone,
            'reason'=>$request->reason,
            'time_start'=>$request->time_start,
            'time_end'=>$request->time_end,
            'user_id'=>$userId,
            'type'=>1,
            'status' => 1,
        ]);
        $user= $this->userService->getById($userId);
        $manager=$this->userService->getManager($user->branch_id);
        $manager->notify(new RequestNotify($contact,$manager));

        return $contact;
    }

    public function get($id)
    {
        return Contact::where('user_id',$id)->get();
    }

    public function getManager($branch_id,$role_id){
        if($role_id===3){
            return Contact::select('contacts.*', 'users.name as user_name')
                    ->join('users', 'users.id', '=', 'contacts.user_id')
                    ->where('contacts.status',2)
                    ->where('users.branch_id',$branch_id)
                    ->orWhere('contacts.status',1)
                    ->where('users.role_id',4)
                    ->where('users.branch_id',$branch_id)
                    ->get();
        }
        return Contact::select('contacts.*', 'users.name as user_name')
                    ->join('users', 'users.id', '=', 'contacts.user_id')
                    ->where('contacts.status',1)
                    ->where('users.branch_id',$branch_id)
                    ->where('users.role_id',5)
                    ->get();
    }

    public function getById($id)
    {
        return Contact::select('contacts.*', 'users.name as user_name')
                    ->join('users', 'users.id', '=', 'contacts.user_id')
                    ->where('contacts.id', $id)
                    ->first();
    }

    public function edit($id, array $payload)
    {
        $contact = Contact::find($id);
        if ($contact === null) {
            return null;
        }
        $contact->update($payload);

        return $contact;
    }

    public function delete($id)
    {
        $contact = Contact::find($id);

        if ($contact === null) {
            return null;
        }
        return  $contact->delete();
    }


    public function userCreate($id)
    {
        $user_id = Contact::where('id', $id)->value('user_id');
        if ($user_id === null) {
            return null;
        }
        $user = $this->userService->getById($user_id);
        if ($user === null) {
            return null;
        }
        return $user->name;
    }

    

    public function handleRequest($newContact, $user, $month)
    {
        switch ($newContact->content) {
            case 'days_on':
                return $this->dayOns($newContact, $month);
            case 'days_off':
                return [];
            case 'over_time':
                return $this->overTime($newContact, $month);
            default:
                return [];
        }
        
    }

    public function dayOns($newContact, $month)
    {
        $user = $this->userService->getById($newContact->user_id);
        $daysOn = $this->userService->getTime($newContact->time_start, $newContact->time_end);

        if ($daysOn <= $user->leave_days) {

            return ['leave_days' => $user->leave_days - $daysOn, 'month' => $month];
        }
        return ['leave_days' => 0, 'flag' => $user->leave_days, 'month' => $month];
    }

    public function overTime($newContact, $month)
    {
        $datetime1 = new DateTime($newContact->time_start);
        $datetime2 = new DateTime($newContact->time_end);

        $diff = $datetime1->diff($datetime2);
        $time = $diff->d * 24 + $diff->h + $diff->i / 60;

        $overTime = $time * 1.5 / 8;
        return ['flag' => round($overTime, 2), 'month' => $month];
    }

    public function forgotToCheck($newContact)
    {
        $day = date('d', strtotime($newContact->time_start));
        $month = date('m', strtotime($newContact->time_start));
        $id = $newContact->user_id;
        $this->calendarService->updateRequest($id, $newContact->time_start, $newContact->time_end, $day, $month);
        return [];
    }

}
