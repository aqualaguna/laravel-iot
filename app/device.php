<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class device extends Model
{
	protected $fillable=['type','name'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function message()
    {
        return $this->hasMany('App\MqttMessage');
    }
}
