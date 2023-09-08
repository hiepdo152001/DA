<?php

namespace App\Http\Controllers\Api;

use App\Exports\ExcelExports;
use App\Http\Controllers\Controller;
use App\Services\CalendarService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CalendarController extends Controller
{
    /**
     * @var CalendarService
     *
     */
    protected $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->middleware('auth');
        $this->calendarService = $calendarService;
    }

    public function index()
    {
        return view('welcome');
    }
    public function create()
    {
        $users = $this->getCurrentLoggedIn();
        $id = $users->id;
        $time_keep = $this->calendarService->create($id);

        if ($time_keep === null) {
            return response()->json([
                'message' => 'create not success'
            ], 500);
        }

        return response()->json(
            $time_keep,
            200
        );
    }

    public function update()
    {
        $users = $this->getCurrentLoggedIn();
        $id = $users->id;
        $time_keep = $this->calendarService->update($id);

        return response()->json(
            $time_keep,
            200
        );
    }


    public function get()
    {
        $user = $this->getCurrentLoggedIn();
        $id = $user->id;

        $time_keep = $this->calendarService->getByUserId($id);

        return response()->json(
            $time_keep,
            200
        );
    }

    public function getByDay()
    {
        $user = $this->getCurrentLoggedIn();
        $id = $user->id;
        $time_keep = $this->calendarService->getByDay($id);
        return response()->json(
            $time_keep,
        );
    }

    public function getWorkTime()
    {
        $user = $this->getCurrentLoggedIn();
        $id = $user->id;
        $work_time = $this->calendarService->getWorkTime($id);

        return response()->json(
            round($work_time, 1),
        );
    }

    public function getNotWork($year, $month)
    {
        $user = $this->getCurrentLoggedIn();
        $notWork = $this->calendarService->getNotWork($year, $month, $user->id);
        return response()->json(
            $notWork,
        );
    }
}
