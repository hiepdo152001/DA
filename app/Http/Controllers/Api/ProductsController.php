<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\products;
use App\Services\ProductsService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * @var products
     */
    protected $products;
    public function __construct(ProductsService $products){
       $this->products=$products;
    }
  
    public function create(Request $request){
        $products=$this->products->create($request);
        return response()->json([
            'data'=>$products
           ],200);
    }

    public function get($id=null){
        $product= $this->products->get($id);
        return response()->json([
         'data'=>$product
        ],200);
     }

    public function update($id,Request $request){
        $product= $this->products->update($id,$request->all());
        return response()->json([
            $product
        ],200);
    }

    public function all(){
        $products= $this->products->all();
        return response()->json([
            $products
        ],200);
    }

    
}
