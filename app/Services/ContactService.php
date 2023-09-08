<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\User;
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
        return $contact;
    }

    public function get($id)
    {
        return Contact::where('user_id',$id)->get();
    }

    public function getById($id)
    {
        return Contact::find($id);
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

    // public function get($department_id, $status)
    // {
    //     $contacts = Contact::select('contacts.*')
    //         ->join('users', 'users.id', '=', 'contacts.user_id')
    //         ->where('contacts.status', $status)
    //         ->where('users.department_id', $department_id)
    //         ->get();
    //     $users = User::with('contacts')->get();
    //     foreach ($contacts as $contact) {
    //         foreach ($users as $user) {
    //             if ($contact->user_id === $user->id) {
    //                 $contact->user_name = $user->name;
    //             }
    //         }
    //     }
    //     return $contacts;
    // }

    public function handleRequest($newContact, $user, $month)
    {
        if ($newContact->content === 'days_on') {

            return $this->dayOns($newContact, $month);
        } elseif ($newContact->content === 'days_off') {
            return [];
        } elseif ($newContact->content === 'special_take_leave') {
            $days = $this->userService->getTime($newContact->time_start, $newContact->time_end);
            return ['flag' => round($days, 2), 'month' => $month];
        } elseif ($newContact->content === 'over_time') {
            return $this->overTime($newContact, $month);
        } elseif ($newContact->content === 'forgot_to_check') {
            return $this->forgotToCheck($newContact);
        } elseif ($newContact->content === 'device_recall') {
            return $this->deviceRecall($newContact);
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
