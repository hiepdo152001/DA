<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products_size extends Model
{
    use HasFactory;
    protected $table = 'products_size';
    protected $fillable = [
        'products_id',
        'size_id',
        'quantity'
    ];
    
}
