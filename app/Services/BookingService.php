<?php

namespace App\Services;

use App\Models\holiday;
use App\Models\import_booking;
use App\Models\products;
use Hamcrest\Type\IsInteger;
use Illuminate\Support\Facades\Hash;

class BookingService
{
    public function create($payload,$user){
        dd($payload);
        $bill = new import_booking;
        $bill->fill($payload); 
        $bill->branch_id = $user->branch_id;
        $bill->user_id = $user->id;
        $bill->status = 0;
        $bill->save(); 

        if(count($payload['product_id']) >0){
            for($i=0; $i< count($payload['product_id']);$i++){
                if(is_integer($payload['product_id'][$i])){
                    $product = products::where('id',$payload['product_id'][$i])->first();
                    if ($product) {
                        $bill->products()->attach($product->id);
                        $product->name = $payload['name'][$i];
                        $product->amount = $payload['amount'][$i];
                        $product->import_price = $payload['import_price'][$i];
                        $product->save();
                        
                    } else {
                    // Sản phẩm chưa tồn tại trong bảng product, tạo mới và thêm vào cả bảng product và bảng trung gian
                    $newProduct = new products;
                    $newProduct->name =  $payload['name'][$i];
                    $newProduct->amount= $payload['amount'][$i];
                    $newProduct->import_price= $payload['import_price'][$i];
                    $newProduct->save();
                    $bill->products()->attach($newProduct->id);
                    }
                }
            }
        }

        
    }

    public function update($id,$payload){
        $holiday=import_booking::findOrFail($id);
        // $holiday->title=$payload->title;
        // $holiday->time_start=$payload->time_start;
        // $holiday->time_end=$payload->time_end;
        $holiday->update($payload);
        return $holiday;
    }

    public function delete($id){
        $holiday= import_booking::find($id);
        return $holiday->delete();
    }

    public function get($id){
        if($id===null ){
            return import_booking::paginate(3);
        }
       
        return import_booking::find($id);
    }

    public function all(){
       
        return import_booking::all();
    }
}
