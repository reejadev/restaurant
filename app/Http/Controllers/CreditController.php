<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Order;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class CreditController extends Controller
{

    public function checkoutPage()
    {
        return view('credit.index');
    }

    public function buy(Order $order)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        $checkout_session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => [
                        'name' => 'Order Payment',
                    ],
                    'unit_amount' => 1000 * 100, // Example amount, adjust accordingly
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('credit.success'),
            'cancel_url' => route('credit.cancel'),
        ]);

        Transaction::create([
            'status'=>'pending',
            'price'=> 'fullamount',
            'session_id'=>$checkout_session->id,
            'user_id'=>Auth::id(),
            

        ]);

        return redirect($checkout_session->url);
    }

    public function success()
    {
        return to_route('credit.index')
        ->with('success', 'Payment success');
    }

    public function cancel()
    {
        return to_route('credit.index')
        ->with('error', 'Payment error');
    }

    public function webhook()
    {
$endpoint_secret = env('STRIPE_WEBHOOK_KEY');

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
    $event =\Stripe\Webhook::constructEvent(
$payload,
$sig_header,
$endpoint_secret

    );
}catch (\UnexpectedValueException $e){

    return response('', 400);

}catch (\Stripe\Exception\SignatureVerificationException $e){
    
    return response('', 400);
}


switch($event->type){
    case 'checkout.session.completed';
    $session = $event->data->object;
$transaction = Transaction::where('session_id',
$session->id)->first();
if ($transaction && $transaction->status === 'pending'){
    $transaction->status = 'paid';
    $transaction->save();
}

default:
echo 'Received unknown event type'. $event->type;

}

return response('');
    }
    
}