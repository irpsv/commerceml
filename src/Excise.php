<?php

namespace irpsv\commerceml;

class Excise
{
	protected $name;
	protected $amountPerOne;
	protected $valute;

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setAmountPerOne(float $value)
	{
		$this->amountPerOne = $value;
	}

	public function getAmountPerOne(): ?float
	{
		return $this->amountPerOne;
	}

	public function setValute(Valute $value)
	{
		$this->valute = $value;
	}

	public function getValute(): ?Valute
	{
		return $this->valute;
	}
}
