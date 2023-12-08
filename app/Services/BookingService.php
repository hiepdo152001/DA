<?php

namespace App\Services;

use App\Models\import_booking;
use App\Models\products;

class BookingService
{

    public function create($payload, $user)
{
    $bill = new import_booking;
    $bill->fill($payload);
    $bill->branch_id = $user->branch_id;
    $bill->user_id = $user->id;
    $bill->status = 0;
    $bill->save();
    
    if (isset($payload['product_id']) && count($payload['product_id']) > 0) {
        foreach ($payload['product_id'] as $index => $productId) {
            $amount = intval($payload['amount'][$index]);
            $importPrice = $payload['import_price'][$index];
            $product=null;
            if (is_integer($productId)) {
                $product = products::where('id', $productId)
                    ->where('branch_id', $user->branch_id)
                    ->first();
            }
                // Update existing product
            if ($product != null) {
                $product->amount += abs($amount);
                $product->import_price = ($product->import_price + $importPrice) / 2;
                $product->save();
            }
            else {
                // Create new product
                $product = products::create([
                    'name' => $payload['product_name'][$index],
                    'import_price' => $importPrice,
                    'amount' => $amount,
                    'branch_id' => $user->branch_id,
                    'status' => 0,
                ]);
    
                $product->avatar = 'http://localhost:9000/mybucket/product/avatar/' . $product->id . 'avatar.jpg';
                $product->save();
            }
            // Attach the product to the import booking
            $bill->products()->syncWithoutDetaching([$product->id => [
                'amount' => $amount,
                'import_price' => $importPrice,
                'sum' => $payload['sum'][$index],
                'created_at' => now(),
                'updated_at' => now(),
            ]]);
            
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

    public function all(){
        $bookProducts = import_booking::with(['user', 'products'])->paginate(3);
        return $bookProducts;
        
    }

   // Trong Controller hoặc Service
public function get($search, $user)
{
    if ($user->role_id === 1) {
        $results = import_booking::with(['user', 'products' => function ($query) {
            $query->withPivot('amount', 'import_price', 'sum');
        }])->paginate(2);
    } else {
        // Nếu branch_id của user không null
        if (!empty($search)) {
            $results = import_booking::where('branch_id', $user->branch_id)
                ->where(function ($query) use ($search) {
                    $query->where('id', $search)
                        ->orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('courier', 'like', '%' . $search . '%');
                })->with(['user', 'products' => function ($query) {
                    $query->withPivot('amount', 'import_price', 'sum');
                }])
                ->paginate(2);

        } else {
            $results = import_booking::where('branch_id', $user->branch_id)
            ->with(['user', 'products' => function ($query) {
                $query->withPivot('amount', 'import_price', 'sum');
            }])
            ->paginate(2);
        }
    }

    return $results;
}

    

    public function getById($id){
        return import_booking::with(['user','products' => function ($query) {
            $query->withPivot('amount', 'import_price', 'sum');
        }])->find($id);
    }

   
}
