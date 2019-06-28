<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false;
    //
	protected $fillable = [
        'order_id', 'user_id', 'paid_with', 'status', 'amount', 'created_at', 'card_name', 'card_number', 'card_expiration', 'card_cvv'
    ];
	
	public function user()
	{
      return $this->belongsTo('App\User');
	}
	
	public function orders()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
