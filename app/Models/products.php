<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'price',
        'amount',
        'status',
        'import_price',
        'avatar',
        'category_id',
        'branch_id'

    ];
    public function sizes()
    {
        return $this->belongsToMany(size::class, 'product_size');
    }

    public function importBookings()
    {
        return $this->belongsToMany(import_booking::class, 'book_product');
    }
    
}
