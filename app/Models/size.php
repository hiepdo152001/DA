<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    use HasFactory;
    protected $table = 'size';
    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->belongsToMany(products::class, 'product_size');
    }
    
}
