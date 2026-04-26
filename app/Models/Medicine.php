<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'name',
        'generic_name', 
        'manufacturer',
        'category',
        'price',
        'description',
        'strength',
    ];
}
