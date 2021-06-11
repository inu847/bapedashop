<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatSeller extends Model
{
    use HasFactory;

    function User()
    {
        return $this->belongsTo('App\Models\User');
    }

    function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
}
