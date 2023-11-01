<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use Illuminate\Http\Request;

class ImportBookingController extends Controller
{

   /**
     * @var BookingService
   */
    protected $bookingSerice;
    public function __construct(BookingService $bookingSerice){
        $this->bookingSerice =$bookingSerice;
    }

    public function create(Request $request){
      $user=$this->getCurrentLoggedIn();
       $booking= $this->bookingSerice->create($request->all(),$user);
       return response()->json([
        'data'=>$booking
       ],200);
    }
    public function update($id, Request $request){
        $holiday= $this->bookingSerice->update($id,$request->all());
        return response()->json([
         'data'=>$holiday
        ],200);
     }

     public function delete($id){
      $holiday= $this->bookingSerice->delete($id);
      return response()->json([
       'data'=>$holiday
      ],200);
   }

     public function get($id=null){
        $holidays= $this->bookingSerice->get($id);
        return response()->json([
         'data'=>$holidays
        ],200);
     }
     public function all(){
      $holidays= $this->bookingSerice->all();
      return response()->json([
       'data'=>$holidays
      ],200);
   }
    
}