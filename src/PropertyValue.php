<?php

namespace irpsv\commerceml;

class PropertyValue extends Model
{
	protected $id;
	protected $name;
	protected $value;

	public function setId(string $value)
	{
		$this->id = $value;
	}

	public function getId()
	{
		return $this->id;
	}

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
