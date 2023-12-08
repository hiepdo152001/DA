<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\HolidayService;
use App\Services\StatisticalService;
use Illuminate\Http\Request;

class StatisticalController extends Controller
{

/**
     * @var StatisticalService
     */
    protected $statisticalService;
    public function __construct(StatisticalService $statisticalService){
        $this->statisticalService =$statisticalService;
    }

    

     public function get($id=null){
      $user=$this->getCurrentLoggedIn();
        $sta= $this->statisticalService->get($user);
        return response()->json([
         'data'=>$sta
        ],200);
     }
     
    
}