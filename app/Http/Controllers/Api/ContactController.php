<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Notifications\RequestNotify;
use App\Notifications\StatusNotify;
use App\Notifications\StatusReqNotify;
use App\Services\CalendarService;
use App\Services\ContactService;
use App\Services\UserService;
use DateTime;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    /**
     *@var ContactService
     */
    protected $contacts;

    /**
     *@var UserService
     */
    protected $users;

    /**
     *@var CalendarService
     */
    protected $calendarService;
    public function __construct(
        ContactService $contacts,
         UserService $users,
          CalendarService $calendarService
        )
    {
        $this->contacts = $contacts;
        $this->users = $users;
        $this->calendarService = $calendarService;
    }

    public function create(Request $request)
    {
        $user = $this->getCurrentLoggedIn();
        $id = $user->id;
        $contact = $this->contacts->create($id, $request);

        if ($contact === null) {
            return response()->json([
                'status' => false,
                'message' => 'create contact not success!'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'create contact successful!'
        ], 200);
    }

    public function getByUserLogin()
    {
        $user = $this->getCurrentLoggedIn();
        $requests = $this->contacts->get($user->id);

        return response()->json([
             'data'=>$requests
        ], 200);
    }

    public function get($id)
    {
        $contact = $this->contacts->getById($id);
        if ($contact === null) {
            return response()->json([], 404);
        }
        return response()->json([
            'data'=>$contact
        ], 200);
    }

    public function getStatus($type)
    {
        $user = $this->getCurrentLoggedIn();

        $statuses = [
            'pending' => 1,
            'confirmed' => 2,
            'approved' => 3,
            'declined' => 4,
            'canceled' => 5,
        ];
        $status = $statuses[$type] ?? 1;

        $department_id = $user->department_id;
        $requests = $this->contacts->get($department_id, $status);
        return response()->json([
            'data' => $requests,
        ], 200);
    }

    public function edit($id, Request $request)
    {       
        $user = $this->getCurrentLoggedIn();
        $contact = $this->contacts->getById($id);
        $newContact = $this->contacts->edit($id, $request->all());
        if ($newContact->status === '3') {
            $times = new DateTime($newContact->time_start);
            $month = $times->format("m");

            $payload = $this->contacts->handleRequest($newContact, $user, $month);
            $newContact = $this->contacts->edit($id, $payload);
            $this->users->edit($contact->user_id, $payload);
        }

        $toUser = $this->users->getById($contact->user_id);

        $toUser->notify(new StatusNotify($newContact, $user));
        
        return response()->json([
            $newContact
        ], 200);
    }

    public function delete($id)
    {
        $contact = $this->contacts->delete($id);
        if ($contact === null) {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }

    public function userCreate($id)
    {
        $user = $this->contacts->userCreate($id);
        return response()->json([
            $user
        ], 200);
    }

    public function getManager(){
        $user=$this->getCurrentLoggedIn();
        $contacts= $this->contacts->getManager($user->branch_id,$user->role_id);
        return response()->json([
            $contacts
        ], 200);
    }

}
