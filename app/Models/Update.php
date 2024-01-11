<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    use HasUuids, HasFactory;

    public $timestamps = false;

    protected $fillable = ['created'];

    protected $dateFormat = 'd-m-Y';
}
