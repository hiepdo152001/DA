<?php

namespace App\Services;

use App\Models\category;
use Illuminate\Support\Facades\Hash;

class CategoryService
{
    public function create($payload){
       return category::create($payload);
    }

    public function update($id,$payload){
        $category=category::findOrFail($id);
        $category->update($payload);
        return $category;
    }

    public function delete($id){
        $category= category::find($id);
        $category->status=2;
        return $category->save();
    }

    public function get($id){
        if($id===null ){
            return category::paginate(3);
        }
       
        return category::find($id);
    }

    public function all(){
       
        return category::all();
    }
}
