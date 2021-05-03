<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    function User()
    {
        return $this->belongsTo('App\Models\User');
    }

    function Job()
    {
        return $this->belongsTo('App\Models\Job');
    }
}
