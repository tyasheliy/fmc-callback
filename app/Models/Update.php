<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    use HasUuids;

    public $timestamps = false;

    protected $fillable = ['created'];

    protected $dateFormat = 'd-m-Y';
}
