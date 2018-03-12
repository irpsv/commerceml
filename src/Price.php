<?php

namespace irpsv\commerceml;

class Price extends Model
{
	protected $performance;
	protected $priceTypeId;
	protected $pricePerOne;
	protected $valute;
	protected $minCount;
	protected $catalogId;
	protected $unit;

	public function setPerformance(string $value)
	{
		$this->performance = $value;
	}

	public function getPerformance()
	{
		return $this->performance;
	}

	public function setPriceTypeId(string $value)
	{
		$this->priceTypeId = $value;
	}

	public function getPriceTypeId()
	{
		return $this->priceTypeId;
	}

	public function setPricePerOne(float $value)
	{
		$this->pricePerOne = $value;
	}

	public function getPricePerOne()
	{
		return $this->pricePerOne;
	}

	public function setValute(Valute $value)
	{
		$this->valute = $value;
	}

	public function getValute()
	{
		return $this->valute;
	}

	public function setMinCount(int $value)
	{
		$this->minCount = $value;
	}

	public function getMinCount()
	{
		return $this->minCount;
	}

	public function setCatalogId(string $value)
	{
		$this->catalogId = $value;
	}

	public function getCatalogId()
	{
		return $this->catalogId;
	}

	public function setUnit(Unit $value)
	{
		$this->unit = $value;
	}

	public function getUnit()
	{
		return $this->unit;
	}
}
