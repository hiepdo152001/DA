<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class holiday extends Model
{
    use HasFactory;
    protected $table = 'holiday';
    protected $fillable = [
        'title',
        'time_start',
        'time_end'
    ];
}