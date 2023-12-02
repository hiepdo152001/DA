<?php

namespace App\Console\Commands;

use App\Services\UserService;
use Illuminate\Console\Command;

class LeaveDaysUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    /**
     * The name and signature of the console command.
     *
     * @var UserService
     */
    protected $userService;
    protected $signature = 'leave-days:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update leave days for employee';
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = \App\Models\User::all();
        foreach ($users as $user) {
            $this->userService->leaveDays($user->id);
        }
        $this->info('Leave days updated successfully!');
    }
}
