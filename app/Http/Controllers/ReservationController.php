<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Reservation;
use App\Services\DiscountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::id();
    
            // Create and save the reservation
            $reservation = new Reservation;
            $reservation->user_id = $user_id;
            $reservation->Name = $request->input('Name');
            $reservation->email = $request->input('email');
            $reservation->phone = $request->input('phone');
            $reservation->guest = $request->input('guest');
            $reservation->date = $request->input('date');
            $reservation->time = $request->input('time');
            $reservation->message = $request->input('message');
            $reservation->cost = $request->input('cost'); // Assuming 'cost' is passed from the form
            $reservation->schedule_id = $request->input('schedule_id'); // Assuming 'schedule_id' is passed from the form
    
            // Save the reservation first
            $reservation->save();
    
    
            // Redirect to the payment page with the reservation ID, cost, and discount
            return redirect()->route('reservationpay', ['id' => $reservation->id]);
        } else {
            return redirect('/login');
        }
    }
    
    public function reservationPay($id)
    {
        // Fetch the reservation using the ID
        $reservation = Reservation::find($id);
    
        // Check if the reservation exists
        if (!$reservation) {
            return redirect()->back()->with('error', 'Reservation not found');
        }
    
        // Get cost from the reservation
        $cost = $reservation->cost;
        
        // $booking = ['total_price' => $cost];
        
        $discount = Discount::where('schedule_id', $reservation->schedule_id)->first();

        $discountService = new DiscountService();
        $discountAmount = 0;
    
        if ($discount) {
            $discountAmount = $discountService->applyDiscount($cost, $discount);
        }
        
    
        // Pass cost and discount amount to the view
        return view('reservationpay', [
            'cost' => $cost,
            'discount' => $discountAmount,
        ]);

}

}
     