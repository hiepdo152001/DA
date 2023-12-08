<?php

namespace App\Services;

use App\Models\bills;
use App\Models\holiday;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StatisticalService
{
    



    public function get($user){
        if($user->role_id ==1){
            $totalAmount = bills::where('status', 2)->sum('total_amount');

        }
        else{
            $totalAmount = bills::where('branch_id', $user->branch_id)->sum('total_amount');

        }
        return $totalAmount;
    }

    
}
