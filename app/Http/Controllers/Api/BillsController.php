<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bills;
use App\Models\billsDetails;
use App\Models\orderDetails;
use App\Models\orders;
use App\Services\BillsService;
use App\Services\HolidayService;
use Illuminate\Http\Request;

class BillsController extends Controller
{
/**
     * @var BillsService
     */
    protected $billsService;
    public function __construct(BillsService $billsService){
        $this->billsService =$billsService;
    }

    public function create(Request $request){
      $user=$this->getCurrentLoggedIn();
      if(!$user){
         $cart = $request->session()->get('cart');
         $bill = bills::create([
            "name" => $request->name,
            'email' => $request -> email,
            'address' => $request-> address,
            'phone'=> $request->phone,
            'total_amount' => 0,
            'branch_id' => $request->branch_id
         ]);
         $total_amount =0;
         $arrId=$request->keyProduct;
         foreach ($cart as $cartKey => $cartValue) {
            foreach ($arrId as $arrIdValue) {
                if ($cartKey == $arrIdValue) {
                  $value =$cartValue->getAttributes();
                  billsDetails::create([
                     'bills_id' => $bill->id,
                     'product_id' => $value['id'],
                     'quantity' => $value['quantity'],
                     'subtotal' => $value['price'] * $value['quantity'],
                  ]);
                  $total_amount += $value['price'] * $value['quantity'];
                }
            }
        }
        $bill->total_amount = $total_amount;
        $bill->save();
      }
      else{
         $arrId=$request->keyProduct;
         $carts =orders::where('user_id',$user->id)->first();
         $cart= orderDetails::where('orders_id',$carts->id)->get();
         $bill = bills::create([
            'user_id' => $user->id,
            'total_amount' => 0,
            'branch_id' => $request->branch_id
         ]);
         $total_amount =0;
         foreach ($cart as $cartKey => $cartValue) {
            foreach ($arrId as $arrIdValue) {
                if ($cartKey == $arrIdValue) {
                  $value =$cartValue->getAttributes();
                  
                  billsDetails::create([
                     'bills_id' => $bill->id,
                     'product_id' => $value['product_id'],
                     'quantity' => $value['quantity'],
                     'subtotal' => $value['subtotal'] ,
                  ]);
                  $total_amount += $value['subtotal'];
                }
            }
        }
        $bill->total_amount = $total_amount;
        $bill->save();
      }
      //  $holiday= $this->billsService->create($request->all());
       return response()->json([
         'message'=> "success"
       ],200);
    }
    public function update($id,Request $request){
        $bill= $this->billsService->update($id,$request->status);
        return response()->json([
         'data'=>$bill
        ],200);
     }

     public function delete($id){
      $bill= $this->billsService->delete($id);
      return response()->json([
       'data'=>$bill
      ],200);
   }

     public function get(){
      $user=$this->getCurrentLoggedIn();
        $bills= $this->billsService->get($user);
        return response()->json([
         'data'=>$bills
        ],200);
     }
     public function all(){
      $holidays= $this->billsService->all();
      return response()->json([
       'data'=>$holidays
      ],200);
   }
    
}