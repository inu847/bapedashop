<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    function User()
    {
        return $this->belongsTo('App\Models\User');
    }

    function order()
    {
        return $this->hasMany('App\Models\Order');
    }

    function suggestion()
    {
        return $this->hasMany('App\Models\Suggestion');
    }
}
