<?php

namespace App\Services;

use App\Models\bills;
use App\Models\billsDetails;
use App\Models\holiday;
use App\Models\orderDetails;
use App\Models\orders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BillsService
{
    public function create($payload){
       return bills::create($payload);
        
    }

    public function update($id,$payload){
        $holiday=bills::findOrFail($id);
        // $holiday->title=$payload->title;
        // $holiday->time_start=$payload->time_start;
        // $holiday->time_end=$payload->time_end;
        $holiday->update($payload);
        return $holiday;
    }

    public function delete($id){
        $holiday= bills::find($id);
        return $holiday->delete();
    }

    public function get($user){
        if($user->role_id <3 || $user->role_id == 4){
            $orderDetails = bills::with('billDetails.product')->paginate(3);
            return $orderDetails;
        }
        $orderDetails = bills::with('billDetails.product')->where('user_id', $user->id)->first();

        return $orderDetails;
    }

    public function all(){
       
        return bills::all();
    }
}
