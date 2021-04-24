<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    function Buyer()
    {
        return $this->belongsTo('App/Models/Buyer');
    }

    function User()
    {
        return $this->belongsTo('App/Models/User');
    }
}
