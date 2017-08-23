<?php

namespace irpsv\commerceml\docs;

use irpsv\commerceml\Group;
use irpsv\commerceml\Property;
use irpsv\commerceml\PriceType;
use irpsv\commerceml\Contragent;

class Classifier
{
	protected $id;
	protected $name;
	protected $desc;
	protected $owner;
	protected $groups = [];
	protected $properties = [];
	protected $priceTypes = [];

	public function setId(string $value)
	{
		$this->id = $value;
	}

	public function getId(): ?string
	{
		return $this->id;
	}

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setDesc(string $value)
	{
		$this->desc = $value;
	}

	public function getDesc(): ?string
	{
		return $this->desc;
	}

	public function setOwner(Contragent $value)
	{
		$this->Owner = $value;
	}

	public function getOwner(): Contragent
	{
		return $this->Owner;
	}

	public function addGroup(Group $value)
	{
		$this->groups[] = $value;
	}

	public function getGroups(): array
	{
		return $this->groups;
	}

	public function addProperty(Property $value)
	{
		$this->properties[] = $value;
	}

	public function getProperties(): array
	{
		return $this->properties;
	}

	public function addPriceType(PriceType $value)
	{
		$this->priceTypes[] = $value;
	}

	public function getPriceTypes(): array
	{
		return $this->priceTypes;
	}
}
