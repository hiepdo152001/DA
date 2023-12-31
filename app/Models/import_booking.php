<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class import_booking extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'import_booking';
        protected $fillable = [
            'branch_id',
            'name',
            'location',
            'courier',
            'phone_courier',
            'daily_name',
            'phone_daily',
            'user_id',
            'status',
            'total_price',
        ];
    
        public function products()
        {
            return $this->belongsToMany(products::class, 'book_product');
        }

        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }

        

}
