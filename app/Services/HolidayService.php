<?php

namespace App\Services;

use App\Models\holiday;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HolidayService
{
    public function create($payload){
       return holiday::create($payload);
        
    }

    public function update($id,$payload){
        $holiday=holiday::findOrFail($id);
        // $holiday->title=$payload->title;
        // $holiday->time_start=$payload->time_start;
        // $holiday->time_end=$payload->time_end;
        $holiday->update($payload);
        return $holiday;
    }

    public function delete($id){
        $holiday= holiday::find($id);
        return $holiday->delete();
    }

    public function get($id){
        if($id===null){
            return holiday::all();
        }
        return holiday::find($id);
    }
}
