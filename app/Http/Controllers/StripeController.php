<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\deepCopy;
use App\Services\StripeService;
use Illuminate\Http\Response;
use App\Models\Customer as CustomerModel;
use App\Models\Invoice as InvoiceModel;

class StripeController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function getCustomers()
    {
        $response = $this->stripeService->getCustomers();

        foreach ($response->data as $stripeCustomer) {
            // Check if a customer with this Stripe ID exists in MongoDB
            $customer = CustomerModel::where('stripe_id', $stripeCustomer->id)->first();
        
            if ($customer) {
                // Update existing customer
                $customer->update([
                    'email' => $stripeCustomer->email,
                    'name' => $stripeCustomer->name,
                    'phone' => $stripeCustomer->phone,
                    // Add other fields you want to update
                ]);
            } else {
                // Create new customer document
                CustomerModel::create([
                    'stripe_id' => $stripeCustomer->id,
                    'email' => $stripeCustomer->email,
                    'name' => $stripeCustomer->name,
                    'phone' => $stripeCustomer->phone,
                    // Add other fields you want to store
                ]);
            }
        }

        return response()->json(["result" => "ok"], 201);
    }

    public function getInvoices()
    {
        $response = $this->stripeService->getInvoices();

        foreach ($response->data as $stripeInvoice) {
            // Check if a customer with this Stripe ID exists in MongoDB
            $invoice = InvoiceModel::where('stripe_id', $stripeInvoice->id)->first();
        
            if ($invoice) {
                // Update existing invoice
                $invoice->update([
                    'customer_id' => $stripeInvoice->customer,
                    'amount_due' => $stripeInvoice->amount_due,
                    'amount_paid' => $stripeInvoice->amount_paid,
                    'amount_remaining' => $stripeInvoice->amount_remaining,
                    'attempt_count' => $stripeInvoice->attempt_count,
                    'due_date' => $stripeInvoice->due_date,
                    'automatic_tax' => $stripeInvoice->automatic_tax,
                    // Add other fields you want to update
                ]);
            } else {
                // Create new invoice document
                InvoiceModel::create([
                    'stripe_id' => $stripeInvoice->id,
                    'customer_id' => $stripeInvoice->customer,
                    'amount_due' => $stripeInvoice->amount_due,
                    'amount_paid' => $stripeInvoice->amount_paid,
                    'amount_remaining' => $stripeInvoice->amount_remaining,
                    'attempt_count' => $stripeInvoice->attempt_count,
                    'due_date' => $stripeInvoice->due_date,
                    'automatic_tax' => $stripeInvoice->automatic_tax,
                    // Add other fields you want to store
                ]);
            }
        }

        return response()->json(["result" => "ok"], 201);
    }
}
