<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function checkout(Request $request) {
        Stripe::setApiKey(env('STRIPE_SECRET_kEY'));
        
        $paymentIntent = PaymentIntent::create([
            'amount' => 2000,
            'currency' => 'usd',
            'description' => 'Example payment'
        ]);
        
        return view('checkout', ['clientSecret' => $paymentIntent->client_secret]);
    }

    public function paymentSuccess() {
        return response()->json('Success!');
    }

    public function paymentNotified(Request $request) {
        $intermediate = $request->all();
        $result = json_encode($intermediate);
        Log::error($result);
    }
}
