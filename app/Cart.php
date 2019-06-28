<?php 


namespace App;


class Cart
{
	public $items;  // ['id'=> ['quantity'=> , 'price'=> , 'data'=> ]]
	public $totQuant;
	public $totPrice;
	
	
	public function __construct($preCart)
	{
		if($preCart != null){
			
			$this->items = $preCart->items;
			$this->totQuant = $preCart->totQuant;
			$this->totPrice = $preCart->totPrice;
			
		} else{
			
			$this->items = [];
			$this->totQuant = 0;
			$this->totPrice = 0;
			
		}
	}
	
	public function addItem($id, $product){
		
		$price = (int)str_replace("HRK:","", $product->price);
		
		if(array_key_exists($id, $this->items)){
			
			$productAdd = $this->items[$id];
			$productAdd['quantity']++;
			
		} else{
			
			$productAdd = ['quantity' => 1, 'price' => $price, 'data' => $product];
			
		}
		
		$this->items[$id] = $productAdd;
		$this->totQuant++;
		$this->totPrice = $this->totPrice + $price;
	}
	
	public function updatePriceAndQuantity(){
		
		$totalPrice = 0;
		$totalQuantity = 0;
		
		foreach($this->items as $item){
			$totalPrice = $totalPrice + $item['price'];
			$totalQuantity = $totalQuantity + $item['quantity'];
		}
		
		$this->totQuant = $totalQuantity;
		$this->totPrice = $totalPrice;
	}
	
}

