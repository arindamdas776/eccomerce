<?php

namespace App;



class cart 
{
    public $content = null;
	public $totalQty =0;
	public $totalPrice =0;
	
	public function __construct($oldCart){
		
		if($oldCart){
			
			$this->content = $oldCart->content;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}
	public function add($item,$slug){
		
		$storeProduct = ['qty' => 0, 'price'=> $item->price, 'item' => $item];
		
			if($this->content){
				
				if(array_key_exists($slug,$this->content)){
					
					$storeProduct = $this->content[$slug];
				}
			}
			$storeProduct['qty'] ++;
			$storeProduct['price'] = $item->price * $storeProduct['qty'];
			$this->totalQty++;
			$this->totalPrice += $item->price;
			$this->content[$slug] = $storeProduct;
	}
	// incasse the properties  are private or protected//

	public function remove($product,$slug){
		$this->content[$slug]['qty']--;
		$this->content[$slug]['price']-= $this->content[$slug]['item']['price'];
		$this->totalPrice -= $this->content[$slug]['item']['price'];
		$this->totalQty--;
		
			if($this->content[$slug]['qty'] <=0){
				
				unset($this->content[$slug]);
			}
	}
	public function delete($slug){
		$this->totalPrice -= $this->content[$slug]['price'];
		$this->totalQty -= $this->content[$slug]['qty'];
		unset($this->content[$slug]);
	}
	
} 
