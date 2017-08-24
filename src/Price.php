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

	public function setPerformance(string $value)
	{
		$this->performance = $value;
	}

	public function getPerformance(): ?string
	{
		return $this->performance;
	}

	public function setPriceTypeId(string $value)
	{
		$this->priceTypeId = $value;
	}

	public function getPriceTypeId(): ?string
	{
		return $this->priceTypeId;
	}

	public function setPricePerOne(float $value)
	{
		$this->pricePerOne = $value;
	}

	public function getPricePerOne(): ?float
	{
		return $this->pricePerOne;
	}

	public function setValute(Valute $value)
	{
		$this->valute = $value;
	}

	public function getValute(): ?Valute
	{
		return $this->valute;
	}

	public function setMinCount(int $value)
	{
		$this->minCount = $value;
	}

	public function getMinCount(): ?int
	{
		return $this->minCount;
	}

	public function setCatalogId(string $value)
	{
		$this->catalogId = $value;
	}

	public function getCatalogId(): ?string
	{
		return $this->catalogId;
	}
}
