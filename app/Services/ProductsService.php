<?php

namespace App\Services;

use App\Models\products;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProductsService
{
    public function create($request){
        $product=products::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'category_id'=>$request->category_id,
            'import_price'=>$request->import_price,
            'amount'=>$request->amount,
            'branch_id'=>$request->branch_id,
            'status'=>0,
        ]);
        if($request->file('imageAvt')){
            $this->addAvt($request->file('imageAvt'),$product);
        }
        if($request->check > 0){
            for($i = 0; $i < 4; $i++){
                if($request->avatarDetail[$i]){
                    $this->addAvtDetail($request->avatarDetail[$i],$product,$i);
                }
            }
        }
        
        return $product;
    }

    public function addAvt($avt,$product){
        Storage::putFileAs('product/avatar/', $avt, $product->id . 'avatar.jpg');
            $product->avatar = 'http://localhost:9000/mybucket/product/avatar/'. $product->id . 'avatar.jpg';
            $product->save();
    }

    public function addAvtDetail($avt, $product, $key) {
        Storage::putFileAs("product/detail/{$product->id}/", $avt, $key . 'avatar.jpg');
    }

    public function update($id,$payload){
        $products = $this->get($id);
        $products->update($payload);
        $productSizes = products::with('sizes')->get();
        for ($key = 1, $value = 36; $key <= 10; $key++, $value++) {
            $size = "size".$value;
            $amount= $payload[$size];
            if ($payload[$size] !== null){
                $product = products::find($id);
                //neu co roi tien hanh cap nhat
                $product->sizes()->sync([$key => ['quantity' => $amount]], false);
            }
        }
        $product = products::with(['sizes' => function ($query) {
            $query->withPivot('quantity');
        }])->find($id);

        if($payload['checkAvt'] == 1){
            if (Storage::exists('product/avatar/' . $id . 'avatar.jpg')) {
                Storage::delete('product/avatar/' . $id . 'avatar.jpg');
            }
            Storage::putFileAs('product/avatar',$payload['imageAvt'], $id. 'avatar.jpg');
        }
        if($payload['checkDetail'] == 1){
            $avatarDetail = $payload['avatarDetail'];
            for($i = 0; $i < 4; $i++){
                if (Storage::exists("product/detail/{$id}/" . $i . 'avatar.jpg')) {
                    Storage::delete("product/detail/{$id}/" . $i . 'avatar.jpg');
                }
                if($i < count($avatarDetail)){
                    Storage::putFileAs("product/detail/{$id}/",$avatarDetail[$i], $i . 'avatar.jpg');
                }
                
            }
        }
        return $product;
    }

    public function delete($id){
        $products= products::find($id);
        return $products->delete();
    }

    public function get($id){
        if($id===null ){
            return products::paginate(6);
        }
       
        return products::with(['sizes' => function ($query) {
            $query->withPivot('quantity');

        }])->find($id);
    }
    
    public function all(){
        return products::all();
    }

}
