<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class billsDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'bill_id', 'product_id', 'quantity', 'subtotal',
    ];

    public function bill()
    {
        return $this->belongsTo(bills::class);
    }

    public function product()
    {
        return $this->belongsTo(products::class);
    }
}
