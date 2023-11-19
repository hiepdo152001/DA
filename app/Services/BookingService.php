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
                    $amount = $payload['amount'][$index];
                    $importPrice = $payload['import_price'][$index];
    
                    $productsData[] = [
                        'id' => $productId,
                        'name' => $payload['name'][$index],
                        'amount' => $amount,
                        'import_price' => $importPrice,
                    ];
                }
            }
    
            $this->syncProducts($bill, $productsData);
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
