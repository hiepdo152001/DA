<?php

namespace App\Services;

use App\Models\holiday;
use App\Models\import_booking;
use App\Models\products;
use Hamcrest\Type\IsInteger;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
        $productsData = [];

        foreach ($payload['product_id'] as $index => $productId) {
            if (is_integer($productId)) {
                $product =  products::where('id', $productId)
                ->where('branch_id', $user->branch_id)
                ->first();
                $product->amount = abs(intval($product->amount) + intval($payload['amount'][$index]));
                $product -> import_price = ($product -> import_price + $payload['import_price'][$index]) /2;
                $product->save();
            }
            else{
              $pro = products::create([
                    'name'=> $payload['product_name'][$index],
                    'import_price'=> $payload['import_price'][$index],
                    'amount'=> $payload['amount'][$index],
                    'branch_id'=> $user->branch_id,
                    'status'=> 0,
                ]);
                $pro-> avatar = 'http://localhost:9000/mybucket/product/avatar/'. $pro->id . 'avatar.jpg';
                $pro->save();
            }
        }

       
    }
}
    
    protected function syncProducts($bill, $productsData)
    {
        $syncData = [];
    
        foreach ($productsData as $productData) {
            $product = products::find($productData['id']);
    
            if ($product) {
                // Nếu sản phẩm đã tồn tại, cập nhật thông tin
                $product->update($productData);
            } else {
                // Nếu sản phẩm chưa tồn tại, tạo mới
                $newProduct = new products($productData);
                $newProduct->save();
                $product = $newProduct;
            }
    
            $syncData[$product->id] = [
                'amount' => $productData['amount'],
                'import_price' => $productData['import_price'],
            ];
        }
    
        $bill->book_products()->sync($syncData);
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
