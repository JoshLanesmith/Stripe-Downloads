<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Customer extends Model
{
    //
    protected $connection = 'mongodb';

    protected $fillable = [
        'stripe_id',
        'name',
        'email',
        'phone',
        'address',
        'metadata',
    ];    

    protected $casts = [
        'address' => 'array',
        'metadata' => 'array',
    ];
}
