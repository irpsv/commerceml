<?php

namespace irpsv\commerceml;

class Catalog
{
	protected $id;
	protected $classifierId;
	protected $name;
	protected $owner;
	protected $products = [];
	protected $desc;

	public function setId(string $value)
	{
		$this->id = $value;
	}

	public function getId(): ?string
	{
		return $this->id;
	}

	public function setClassifierId(string $value)
	{
		$this->classifierId = $value;
	}

	public function getClassifierId(): ?string
	{
		return $this->classifierId;
	}

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setOwner(Contragent $value)
	{
		$this->owner = $value;
	}

	public function getOwner(): ?Contragent
	{
		return $this->owner;
	}

	public function addProduct(Product $value)
	{
		$this->products[] = $value;
	}

	public function getProducts(): array
	{
		return $this->products;
	}

	public function setDesc(string $value)
	{
		$this->desc = $value;
	}

	public function getDesc(): ?string
	{
		return $this->desc;
	}
}
