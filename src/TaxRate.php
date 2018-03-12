<?php

namespace irpsv\commerceml;

class TaxRate extends Model
{
	protected $name;
	protected $rate;

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setRate(float $value)
	{
		$this->rate = $value;
	}

	public function getRate()
	{
		return $this->rate;
	}
}
