<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $connection = 'mongodb';

    protected $fillable = [
        'stripe_id',
        'customer_id',
        'amount_due',
        'amount_paid',
        'amount_remaining',
        'attempt_count',
        'due_date',
        'automatic_tax',
    ];   

}
