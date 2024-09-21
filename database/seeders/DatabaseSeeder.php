<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Discount;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Discount::create([
            'name' => 'New Year Discount',
            'type' => 'percentage',  // 'percentage' or 'fixed'
            'value' => 10,  // 10% discount
            'max_uses' => 100,  // Can be used up to 100 times
            'max_discount' => 500,  // Maximum discount allowed is 500 (currency unit)
        ]);

        Discount::create([
            'name' => 'Holiday Special',
            'type' => 'fixed',  // Fixed discount
            'value' => 200,  // Flat 200 off
            'max_uses' => 50,  // Can be used up to 50 times
            'max_discount' => 200,  // Since it's a fixed discount, max_discount can be the same as value
        ]);

        Discount::create([
            'name' => 'Family Booking Discount',
            'type' => 'percentage',  // Percentage-based discount
            'value' => 15,  // 15% discount
            'max_uses' => 20,  // Can be used up to 20 times
            'max_discount' => 1000,  // Maximum discount allowed is 1000
        ]);

        Discount::create([
            'name' => 'Loyalty Discount',
            'type' => 'fixed',
            'value' => 100,  // Flat 100 off
            'max_uses' => 10,  // Can be used up to 10 times
            'max_discount' => 100,  // Flat 100 off
        ]);

        Discount::create([
            'name' => 'Early Bird Special',
            'type' => 'percentage',  // Percentage-based discount
            'value' => 20,  // 20% off
            'max_uses' => 200,  // Can be used up to 200 times
            'max_discount' => 800,  // Maximum discount allowed is 800
        ]);
    
    }
}