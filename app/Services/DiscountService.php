<?php

namespace App\Services;

class DiscountService
{
    public function applyDiscount($cost, $discount)
    {
        if ($discount->type == 'percentage') {
          
            $discountAmount = ($cost * $discount->value) / 100;
        } else {
            $discountAmount = $discount->value;
        }

        // Apply maximum discount limit
        if ($discount->max_discount && $discountAmount > $discount->max_discount) {
            $discountAmount = $discount->max_discount;
        }

        return $discountAmount;
    }
}