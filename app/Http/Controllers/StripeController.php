<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class StripeController extends Controller
{

  

    public function stripeCheckout(Request $request)
    {


        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $today = Carbon::now()->startOfDay();
        $orders = Order::whereDate('created_at', $today)->get();
$lineItems = [];
 foreach($orders as $order){
    $lineItems[] = [
            'price_data' => [
                'currency' => 'inr',
                'product_data' => [
                   'name' => $order->foodname,

                ],
               'unit_amount' =>$order->price*100,// Example amount, adjust accordingly
             
            ],
            'quantity' => $order->quantity, 
    ];

 }      

    $checkout_session = $stripe->checkout->sessions->create([
        'payment_method_types' => ['card'],
        'line_items' => $lineItems,       
        'mode' => 'payment',
        'success_url' => route('stripe.success'),
        'cancel_url' => route('stripe.cancel'),
    ]);

 
    return redirect($checkout_session->url);
}

public function stripeSuccess()
{
    // Clear today's orders
    $today = Carbon::now()->startOfDay();
    Order::whereDate('created_at', $today)->delete();
    session()->forget('cart');

    $user_id = Auth::id();
    Cart::where('user_id', $user_id)->delete();
    // Redirect to a confirmation page or homepage
    return redirect()->route('home')->with('success', 'Payment was successful and your order has been processed.');
}

public function stripeCancel()
{
    // Redirect to a cancellation page or homepage
    return redirect()->route('home')->with('error', 'Payment was cancelled.');
}

}