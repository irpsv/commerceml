<?php

namespace irpsv\commerceml;

class Catalog extends Model
{
	protected $id;
	protected $classifierId;
	protected $name;
	protected $desc;
	protected $owner;
	protected $products = [];
	protected $isOnlyChanges;

	public function setId(string $value)
	{
		$this->id = $value;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setClassifierId(string $value)
	{
		$this->classifierId = $value;
	}

	public function getClassifierId()
	{
		return $this->classifierId;
	}

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setOwner(Contragent $value)
	{
		$this->owner = $value;
	}

	public function getOwner()
	{
		return $this->owner;
	}

	public function addProduct(Product $value)
	{
		$this->products[] = $value;
	}

	public function getProducts()
	{
		return $this->products;
	}

	public function setDesc(string $value)
	{
		$this->desc = $value;
	}

	public function getDesc()
	{
		return $this->desc;
	}

	public function setIsOnlyChanges(bool $value)
	{
		$this->isOnlyChanges = $value;
	}

	public function getIsOnlyChanges()
	{
		return $this->isOnlyChanges;
	}
}
