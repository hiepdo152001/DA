<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class branch extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'branch';
    protected $fillable = [
        'name'
    ];
    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
