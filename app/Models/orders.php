<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'total_amount', 'branch_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(orderDetails::class);
    }
}
