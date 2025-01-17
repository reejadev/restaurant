<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familymember extends Model
{
    use HasFactory;

    protected $table = 'family_member';

    protected $fillable = ['family_member_id'];
}