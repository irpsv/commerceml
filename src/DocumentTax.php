<?php

namespace irpsv\commerceml;

class DocumentTax extends Tax
{
	protected $amount;
	protected $rate;

	public function setAmount(float $value)
	{
		$this->amount = $value;
	}

	public function getAmount()
	{
		return $this->amount;
	}

	public function setRate(float $value)
	{
		$this->rate = $value;
	}

	public function getRate()
	{
		return $this->rate;
	}

	public static function createFrom(Tax $value)
	{
		$tax = new DocumentTax();
		if ($value->getName()) {
			$tax->setName($value->getName());
		}
		if ($value->getIsAccounted()) {
			$tax->setIsAccounted($value->getIsAccounted());
		}
		if ($value->getIsExcise()) {
			$tax->setIsExcise($value->getIsExcise());
		}
		return $tax;
	}
}
