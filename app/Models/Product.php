<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
	
	protected $fillable = [
        'name', 'description', 'image', 'price', 'type',
    ];
	
	public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }
	
	public function getPriceAttribute($value){
		$newPrice = "HRK:" . $value;
		return $newPrice;
	}
}
