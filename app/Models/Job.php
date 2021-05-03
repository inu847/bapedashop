<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    public function User()
    {
        return $this->belongsTo('App\Models\Users');
    }
    
    public function alamat()
    {
        return $this->hasMany('App\Models\Alamat');
    }
}
