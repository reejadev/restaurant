<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Discount;
use App\Models\Userdiscountusage;
use App\Services\DiscountService;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function applyDiscount(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'amount' => 'required|numeric',
        ]);

        $reservation = Reservation::where('user_id', $request->user_id)
        ->where('schedule_id', $request->schedule_id)
        ->first();

// Example calculation based on guests (if price per guest is fixed)
// $pricePerGuest = 1000; // Example price
// $amount = $reservation->guest * $pricePerGuest;


        $user_id = $validated['user_id'];
        $schedule_id = $validated['schedule_id'];
        $totalAmount = $validated['amount'];

        // Initialize DiscountService (service logic created separately)
        $discountService = new DiscountService();

        // Fetch applicable discounts for the schedule
        $discounts = Discount::where('schedule_id', $schedule_id)
            ->where('max_uses', '>', 0)
            ->get();

        $discountAmount = 0;

        foreach ($discounts as $discount) {
            $discountAmount += $discountService->applyDiscount($totalAmount, $discount);
        }

        // Calculate final price after applying discounts
        $finalPrice = $totalAmount - $discountAmount;

        // Return discount amount and final price as JSON response
        return response()->json([
            'discount' => $discountAmount,
            'final_price' => $finalPrice,
        ]);
    }
}