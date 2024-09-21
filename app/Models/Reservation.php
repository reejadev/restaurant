<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'Name',
        'email',
        'phone',
        'guest',
        'date',
        'time',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // If you have a schedule model, link it like this
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}