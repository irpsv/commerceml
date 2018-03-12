<?php

namespace irpsv\commerceml;

class Excise extends Model
{
	protected $name;
	protected $amountPerOne;
	protected $valute;

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setAmountPerOne(float $value)
	{
		$this->amountPerOne = $value;
	}

	public function getAmountPerOne()
	{
		return $this->amountPerOne;
	}

	public function setValute(Valute $value)
	{
		$this->valute = $value;
	}

	public function getValute()
	{
		return $this->valute;
	}
}
