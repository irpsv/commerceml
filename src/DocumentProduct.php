<?php

namespace irpsv\commerceml;

class DocumentProduct extends Product
{
	use DocumentTrait;

	protected $catalogId;
	protected $classifierId;
	protected $pricePerOne;
	protected $count;
	protected $amount;
	protected $unit;
	protected $country;
	protected $gtd;

	public function setCatalogId(string $value)
	{
		$this->catalogId = $value;
	}

	public function getCatalogId()
	{
		return $this->catalogId;
	}

	public function setClassifierId(string $value)
	{
		$this->classifierId = $value;
	}

	public function getClassifierId()
	{
		return $this->classifierId;
	}

	public function setPricePerOne(float $value)
	{
		$this->pricePerOne = $value;
	}

	public function getPricePerOne()
	{
		return $this->pricePerOne;
	}

	public function setCount(float $value)
	{
		$this->count = $value;
	}

	public function getCount()
	{
		return $this->count;
	}

	public function setAmount(float $value)
	{
		$this->amount = $value;
	}

	public function getAmount()
	{
		return $this->getCount() * $this->getPricePerOne();
	}

	public function setUnit(Unit $value)
	{
		$this->unit = $value;
	}

	public function getUnit()
	{
		return $this->unit;
	}

	public function setCountry(string $value)
	{
		$this->country = $value;
	}

	public function getCountry()
	{
		return $this->country;
	}

	public function setGtd(string $value)
	{
		$this->gtd = $value;
	}

	public function getGtd()
	{
		return $this->gtd;
	}
}
