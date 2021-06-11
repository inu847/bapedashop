<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    protected $table = "admins";
    use Notifiable;
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function chat()
    {
        return $this->hasMany('App\Models\ChatSeller');
    }
}
