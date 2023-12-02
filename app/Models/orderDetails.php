<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderDetails extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'subtotal',
    ];

    public function order()
    {
        return $this->belongsTo(orders::class);
    }

    public function product()
    {
        return $this->belongsTo(products::class);
    }
}
