<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'api_key',
    //     'field 1',
    //     'field 2',
    //     'field 3',
    //     'field 4',
    //     'field 5',
    // ];

    function User()
    {
        return $this->belongsTo('App/Models/User');
    }
}
