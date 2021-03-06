<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function alamatId()
    {
        return $this->hasMany('App\Models\Alamat');
    }

    public function productId()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function rating()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function orderId()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function buyer()
    {
        return $this->hasMany('App\Models\Buyer');
    }

    public function roles()
    {
        return $this->hasOne('App\Models\Role');
    }

    public function tools()
    {
        return $this->hasOne('App\Models\Tools');
    }

    public function suggestion()
    {
        return $this->hasMany('App\Models\Suggestion');
    }

    public function job()
    {
        return $this->hasMany('App\Models\Job');
    }

    public function generateToken()
    {
        $this->enkripsi_token = Str::random(60);
        $this->save();
        return $this->enkripsi_token;
    }

    public function chat()
    {
        return $this->hasMany('App\Models\ChatSeller');
    }

    // public function roleId()
    // {
    //     return $this->hasMany('App\Models\Role');
    // }
}
