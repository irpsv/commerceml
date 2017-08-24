<?php

namespace irpsv\commerceml;

class ProductChar extends Model
{
	protected $id;
	protected $name;
	protected $value;

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

	public function setValue(string $value)
	{
		$this->value = $value;
	}

	public function getValue(): ?string
	{
		return $this->value;
	}
}
