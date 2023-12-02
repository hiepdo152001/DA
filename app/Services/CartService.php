<?php

namespace App\Services;

use App\Models\orderDetails;
use App\Models\orders;
use App\Models\products;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CartService
{
    public function create($payload){
       return orders::create($payload);
        
    }

    public function update($id,$payload,$user){
        $order= orders::where('branch_id', $user->branch_id)
                        ->where('user_id',$user->id)->first();
        $product=orderDetails::where('orders_id',$order->id)
                                ->where('product_id',$id)->first();
        $pro=products::find($id);
        $product->quantity += $payload;
        $product->subtotal = $product->quantity * $pro->price;
        $product->save();
        $totalSubtotal = orderDetails::where('orders_id', $order->id)
                        ->sum('subtotal');
        $order->total_amount = $totalSubtotal;
        $order->save();
        $user = User::with('order.orderDetails.product')->find($user->id);
        return $user;
    }

    public function delete($id,$user){
        $order = orders::where('user_id',$user->id)
                        ->where('branch_id',$user->branch_id)->first();
        $product= orderDetails::where('orders_id',$order->id)
                                ->where('product_id',$id)->first();
        return $product->delete();
    }

    public function get($id){
        if($id===null ){
            return orders::paginate(3);
        }
       
        return orders::find($id);
    }

    public function all($user){
        $user = User::with('order.orderDetails.product')->find($user->id);
        return $user;
    }
}
