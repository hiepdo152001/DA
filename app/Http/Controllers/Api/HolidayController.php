<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\HolidayService;
use Illuminate\Http\Request;

class HolidayController extends Controller
{

/**
     * @var HolidayService
     */
    protected $holidayService;
    public function __construct(HolidayService $holidayService){
        $this->holidayService =$holidayService;
    }

    public function create(Request $request){
       $holiday= $this->holidayService->create($request->all());
       return response()->json([
        'data'=>$holiday
       ],200);
    }
    public function update($id, Request $request){
        $holiday= $this->holidayService->update($id,$request->all());
        return response()->json([
         'data'=>$holiday
        ],200);
     }

     public function delete($id){
      $holiday= $this->holidayService->delete($id);
      return response()->json([
       'data'=>$holiday
      ],200);
   }

     public function get($id=null){
        $holidays= $this->holidayService->get($id);
        return response()->json([
         'data'=>$holidays
        ],200);
     }
    
}