<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\WorkTimeNotify;
use App\Services\CalendarService;
use Illuminate\Console\Command;

class AutoTimeKeep extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'worktime:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto sent email with work time to employee';
    /**
     * 
     *
     * @var CalendarService
     */
    protected $calendarService;
    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::whereIn('role_id', [3, 4, 5])->get();
        foreach ($users as $user) {
            $id = $user->id;
            $work_time = $this->calendarService->getWorkTime($id);
            $user->notify(new WorkTimeNotify($work_time));
        }
    }
}
