<?php

namespace irpsv\commerceml;

class PropertyDictionary extends Model
{
	protected $valueId;
	protected $value;

	public function setValueId(string $value)
	{
		$this->valueId = $value;
	}

	public function getValueId()
	{
		return $this->valueId;
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
