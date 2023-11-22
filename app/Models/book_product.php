<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class book_product extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'book_product';
    protected $fillable = [
        'products_id',
        'import_book_id',
        'amount',
        'import_price',
        'sum',
    ];
    
    // public function import_booking()
    // {
    //     return $this->belongsTo(import_booking::class, 'book_id');
    // }

    // public function product()
    // {
    //     return $this->belongsTo(products::class, 'product_id');
    // }
    public function product()
    {
        return $this->belongsTo(products::class);
    }
}
