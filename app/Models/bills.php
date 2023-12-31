<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bills extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'total_amount', 'branch_id','name','email','address','phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function billDetails()
    {
        return $this->hasMany(billsDetails::class);
    }
}
