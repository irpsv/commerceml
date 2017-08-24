<?php

namespace irpsv\commerceml;

class Offer extends Product
{
	protected $prices;
	protected $count;
	protected $storeCounts = []; // остаткиПоСкладам

	public function addPrice(Price $value)
	{
		$this->prices[] = $value;
	}

	public function getPrices(): array
	{
		return $this->prices;
	}

	public function setCount(int $value)
	{
		$this->count = $value;
	}

	public function getCount(): ?int
	{
		return $this->count;
	}

	public function addStoreCount(StoreCount $value)
	{
		$this->storeCounts[] = $value;
	}

	public function getStoreCounts(): array
	{
		return $this->storeCounts;
	}

	public static function createFromProduct(Product $product)
	{
		$offer = new self();
		$offer->setId(
			$product->getId()
		);
		$offer->setName(
			$product->getName()
		);
		$offer->setDesc(
			$product->getDesc()
		);
		$offer->setBarcode(
			$product->getBarcode()
		);
		$offer->setArticul(
			$product->getArticul()
		);
		$offer->setBaseScale(
			$product->getBaseScale()
		);
		$offer->setContragentProductId(
			$product->getContragentProductId()
		);
		$offer->setVendor(
			$product->getVendor()
		);
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
