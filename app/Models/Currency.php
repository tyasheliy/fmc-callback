<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public $timestamps = false;

    protected $keyType = 'string';
    
    protected $fillable = [
        'id',
        'name',
        'num_code',
        'char_code' 
    ];
}
