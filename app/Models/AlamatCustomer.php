<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatCustomer extends Model
{
    use HasFactory;

    function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
