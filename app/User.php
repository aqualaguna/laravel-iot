<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function devices()
    {
        return $this->hasMany('App\device');
    }
    public function addDevice(device $dev)
    {
        return $this->devices()->save($dev);
    }
    public function graph()
    {
        return $this->hasMany(Graph::class);
    }
}
