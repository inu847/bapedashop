<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    function User()
    {
        return $this->belongsTo('App\Models\User');
    }

    function Buyer()
    {
        return $this->belongsTo('App\Models\Buyer');
    }

    function product()
    {
        return $this->hasMany('App\Models\Product');
    }
}
