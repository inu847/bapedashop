<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["nama_product", "deskripsi", "price", "images", "stok", "status", "user_id"];

    use HasFactory;

    function User()
    {
        return $this->belongsTo('App\Models\User');
    }

    function Order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    function cartProduct()
    {
        return $this->hasOne('App\Models\Cart');
    }
}
