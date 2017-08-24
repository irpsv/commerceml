<?php

namespace irpsv\commerceml;

class RequisiteValue extends Model
{
	protected $name;
	protected $value;

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
