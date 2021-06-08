<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    protected $table = "customers";
    use Notifiable;
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    function keranjang()
    {
        return $this->hasMany('App\Models\Keranjang');
    }

    function alamatCustomer()
    {
        return $this->hasMany('App\Models\AlamatCustomer');
    }

    function transaksi()
    {
        return $this->hasMany('App\Models\Transaksi');
    }
}
