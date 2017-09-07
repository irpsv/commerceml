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

	public function getCatalogId(): ?string
	{
		return $this->catalogId;
	}

	public function setClassifierId(string $value)
	{
		$this->classifierId = $value;
	}

	public function getClassifierId(): ?string
	{
		return $this->classifierId;
	}

	public function setPricePerOne(float $value)
	{
		$this->pricePerOne = $value;
	}

	public function getPricePerOne(): ?float
	{
		return $this->pricePerOne;
	}

	public function setCount(float $value)
	{
		$this->count = $value;
	}

	public function getCount(): ?float
	{
		return $this->count;
	}

	public function setAmount(float $value)
	{
		$this->amount = $value;
	}

	public function getAmount(): ?float
	{
		return $this->getCount() * $this->getPricePerOne();
	}

	public function setUnit(Unit $value)
	{
		$this->unit = $value;
	}

	public function getUnit(): ?Unit
	{
		return $this->unit;
	}

	public function setCountry(string $value)
	{
		$this->country = $value;
	}

	public function getCountry(): ?string
	{
		return $this->country;
	}

	public function setGtd(string $value)
	{
		$this->gtd = $value;
	}

	public function getGtd(): ?string
	{
		return $this->gtd;
	}
}
