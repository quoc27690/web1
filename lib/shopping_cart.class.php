<?php

class ShoppingCart
{
	private $items = array();
	private $itemsQuantity = array();
	private $total = 0;
	
	public function __construct()
	{
	}
	
	public static function getInstance()
	{
		if(!isset($_SESSION['shopping_cart']))
		{
			$_SESSION['shopping_cart'] = serialize(new ShoppingCart());
		}
		
		return unserialize($_SESSION['shopping_cart']);
	}
	
	public static function updateInstance($new)
	{
		$_SESSION['shopping_cart'] = serialize($new);
	}
	
	public function addItem($item)
	{
		if (get_class($item) != 'CartItem')
		{
			return;
		}
		
		$id = $item->getId();
		
		if (isset($this->itemsQuantity[$id]) && $this->itemsQuantity[$id] > 0)
		{
			$this->itemsQuantity[$id] += 1;
			$this->items[$id]->setQuantity($this->itemsQuantity[$id]);
			
			$this->updateTotal();
			
			return;
		}
		
		$this->itemsQuantity[$id] = 1;
		$this->items[$id] = $item;
		
		$this->updateTotal();
		
	}
	
	public function updateQuantity($id, $qty)
	{
		$qty = (int) $qty;
		
		$index = 0;
		
		foreach($this->items as &$item)
		{
			if($item->getId() == $id)
			{
				// delete
				
				if ($qty <= 0)
				{
					unset($this->items[$id]);
					unset($this->itemsQuantity[$item->getId()]);
				}
				else
				{
					$item->setQuantity($qty);
				}
				break;
			}
			++$index;
		}
		
		$this->updateTotal();

	}
	
	public function deleteItem($id)
	{
		$this->updateQuantity($id, -1);
	}
	
	public function emptyCart()
	{
		unset($this->items);
		unset($this->itemsQuantity);
		
		$this->updateTotal();
	}
	
	public function getItems()
	{
		return $this->items;
	}
	
	public function countItems()
	{
		return count($this->items);
	}
	
	public function getTotal()
	{
		return $this->total;
	}
	
	public function updateTotal()
	{
		$this->total = 0;
		if (sizeof($this->items) > 0)
		{
			foreach ($this->items as $item)
			{
				$this->total += ($item->getPrice() * $item->getQuantity());
			}
		}
	}
}

?>