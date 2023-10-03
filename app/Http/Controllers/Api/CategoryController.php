<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\products;
use App\Services\CategoryService;
use App\Services\ProductsService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var products
     */
    protected $category;
    public function __construct(CategoryService $category){
       $this->category=$category;
    }
  
    public function create(Request $request){
        $category=$this->category->create($request->all());
        return response()->json([
            'data'=>$category
           ],200);
    }
    public function update($id, Request $request){
        $category= $this->category->update($id,$request->all());
        return response()->json([
         'data'=>$category
        ],200);
     }

     public function delete($id){
      $category= $this->category->delete($id);
      return response()->json([
       'data'=>$category
      ],200);
   }

     public function get($id=null){
        $category= $this->category->get($id);
        return response()->json([
         'data'=>$category
        ],200);
     }
     public function all(){
      $category= $this->category->all();
      return response()->json([
       'data'=>$category
      ],200);
   }
}
