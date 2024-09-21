<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userdiscountusage extends Model
{
    use HasFactory;

    protected $table = 'user_discount_usage';

    protected $fillable = ['usage_count'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // This usage belongs to one discount
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}