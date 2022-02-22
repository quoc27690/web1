<?php

class CartItem
{
	private $id			= -1;
	private $name		= '';
	private $desc		= '';
	private $price		= 0;
	private $quantity	= 1;
	
	public function __construct($id, $name, $desc, $price = 0, $quantity = 1)
	{
		$this->id		= $id;
		$this->name		= $name;
		$this->desc		= $desc;
		$this->price	= (int) $price;
		$this->quantity	= $quantity;
	}
	
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getName()
	{
		return $this->name;
	}
	/*
	public function setName($name)
	{
		$this->name = $name;
	}
	*/
	
	public function getDesc()
	{
		return $this->desc;
	}
	
	public function getPrice()
	{
		return $this->price;
	}
	
	/*
	public function setPrice($price)
	{
		$this->price = $price;
	}
	*/
	
	public function getQuantity()
	{
		return $this->quantity;
	}
	
	public function setQuantity($quantity)
	{
		$this->quantity = $quantity;
	}
}

?>