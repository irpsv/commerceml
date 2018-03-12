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

	public function getName()
	{
		return $this->name;
	}

	public function setValue(string $value)
	{
		$this->value = $value;
	}

	public function getValue()
	{
		return $this->value;
	}
}
