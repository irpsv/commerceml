<?php

class PropertyDictionary
{
	protected $valueId;
	protected $value;

	public function setValueId(string $value)
	{
		$this->valueId = $value;
	}

	public function getValueId(): ?string
	{
		return $this->valueId;
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
