<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	public $timestamps = false;
    //
	protected $fillable = [
        'date', 'status', 'del_date', 'price', 'first_name', 'last_name', 'address', 'city', 'state', 'zip', 'user_id', 'email'
    ];
	
	public function user()
	{
      return $this->belongsTo('App\User');
	}
	
	public function payment()
	{
      return $this->hasOne('App\Models\Payment');
	}
	
	public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
	
}
