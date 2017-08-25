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
		return $this->amount;
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

	public static function createFrom(Product $product)
	{
		$offer = new self();
		if ($product->getId()) {
			$offer->setId($product->getId());
		}
		if ($product->getName()) {
			$offer->setName($product->getName());
		}
		if ($product->getDesc()) {
			$offer->setDesc($product->getDesc());
		}
		if ($product->getBarcode()) {
			$offer->setBarcode($product->getBarcode());
		}
		if ($product->getArticul()) {
			$offer->setArticul($product->getArticul());
		}
		if ($product->getBaseScale()) {
			$offer->setBaseScale($product->getBaseScale());
		}
		if ($product->getContragentProductId()) {
			$offer->setContragentProductId($product->getContragentProductId());
		}
		if ($product->getVendor()) {
			$offer->setVendor($product->getVendor());
		}
		foreach ($product->getGroupsIds() as $item) {
			$offer->addGroupId($item);
		}
		foreach ($product->getPictures() as $item) {
			$offer->addPicture($item);
		}
		foreach ($product->getPropertyValues() as $item) {
			$offer->addPropertyValue($item);
		}
		foreach ($product->getTaxRates() as $item) {
			$offer->addTaxRate($item);
		}
		foreach ($product->getExcises() as $item) {
			$offer->addExcise($item);
		}
		foreach ($product->getAccessories() as $item) {
			$offer->addAccessory($item);
		}
		foreach ($product->getAnalogs() as $item) {
			$offer->addAnalog($item);
		}
		foreach ($product->getProductChars() as $item) {
			$offer->addProductChar($item);
		}
		foreach ($product->getRequisiteValues() as $item) {
			$offer->addRequisiteValue($item);
		}

		return $offer;
	}
}
