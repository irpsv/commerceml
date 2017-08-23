<?php

class TaxRate
{
	protected $name;
	protected $rate;

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setRate(float $value)
	{
		$this->rate = $value;
	}

	public function getRate(): ?float
	{
		return $this->rate;
	}
}
