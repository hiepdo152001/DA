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
        'product_id',
        'book_id',
        'amount',
        'import_price',
        'sum'
    ];

}
