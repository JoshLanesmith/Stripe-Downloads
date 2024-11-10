<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Exception\ApiErrorException;

class StripeService
{
    protected $stripe;

    public function __construct() 
    {
        $this->stripe = new \Stripe\StripeClient(config('services.stripe.test_key'));
    }

    public function getCustomers()
    {
        try {
            return $this->stripe->customers->all(['limit' => 100]);
        } catch (ApiErrorException $e) {
            // Handle the exception
            // return $this->handleApiError($e);
            return;
        }
    }

    public function getInvoices()
    {
        try {
            return $this->stripe->invoices->all(['limit' => 100]);
        } catch (ApiErrorException $e) {
            // Handle the exception
            // return $this->handleApiError($e);
            return;
        }
    }

}