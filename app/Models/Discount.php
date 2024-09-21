<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    protected $fillable = ['name','type','value','max_uses','max_discount'];


    public function discountUsage()
    {
        return $this->hasMany(UserDiscountUsage::class);
    }

    // If the discount is related to a specific schedule
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}