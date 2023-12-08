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

    public function update($id,$status){
        $bill=bills::findOrFail($id);
        $bill->status=$status;
        $bill->save();
        return $bill;
    }

    public function delete($id){
        
        $bill= billsDetails::find($id);
        $bill_id = $bill->bills_id;
        $bills= bills::find($bill_id);
        $bills->total_amount -=  $bill->subtotal;
        $bills->save();
        return $bill->delete();
    }

    public function get($user){
        if($user->role_id < 3 || $user->role_id == 4){
            $orderDetails = bills::with('billDetails.product')->paginate(3);
            return $orderDetails;
        }
        $orderDetails = bills::with('billDetails.product')->where('user_id', $user->id)->where('status', '!=',2)->get();

        return $orderDetails;
    }

    public function all(){
       
        return bills::all();
    }
}
