<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    use HasUuids;

    public $timestamps = false;

    protected $fillable = [
        'nominal',
        'value',
        'update_id',
        'currency_id'
    ];
}
