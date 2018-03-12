<?php

namespace irpsv\commerceml;

class Product extends Model
{
	protected $id;
	protected $name;
	protected $desc;
	protected $barcode;
	protected $articul;
	protected $baseScale; // базовая единица
	protected $contragentProductId;
	protected $groupsIds = [];
	protected $pictures = [];
	protected $vendor;
	protected $propertyValues = [];
	protected $taxRates = []; // ставки налога
	protected $excises = []; // акцизы
	protected $accessories = []; // комплектующие
	protected $analogs = []; // аналоги
	protected $productChars = []; // характеристики
	protected $requisiteValues = []; // значения реквизитов

	public function setId(string $value)
	{
		$this->id = $value;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setDesc(string $value)
	{
		$this->desc = $value;
	}

	public function getDesc()
	{
		return $this->desc;
	}

	public function setBarcode(string $value)
	{
		$this->barcode = $value;
	}

	public function getBarcode()
	{
		return $this->barcode;
	}

	public function setArticul(string $value)
	{
		$this->articul = $value;
	}

	public function getArticul()
	{
		return $this->articul;
	}

	public function setBaseScale(BaseScale $value)
	{
		$this->baseScale = $value;
	}

	public function getBaseScale()
	{
		return $this->baseScale;
	}

	public function setContragentProductId(string $value)
	{
		$this->contragentProductId = $value;
	}

	public function getContragentProductId()
	{
		return $this->contragentProductId;
	}

	public function addGroupId(string $value)
	{
		$this->groupsIds[] = $value;
	}

	public function getGroupsIds()
	{
		return $this->groupsIds;
	}

	public function addPicture(Picture $value)
	{
		$this->pictures[] = $value;
	}

	public function getPictures()
	{
		return $this->pictures;
	}

	public function setVendor(Vendor $value)
	{
		$this->vendor = $value;
	}

	public function getVendor()
	{
		return $this->vendor;
	}

	public function addPropertyValue(PropertyValue $value)
	{
		$this->propertyValues[] = $value;
	}

	public function getPropertyValues()
	{
		return $this->propertyValues;
	}

	public function addTaxRate(TaxRate $value)
	{
		$this->taxRates[] = $value;
	}

	public function getTaxRates()
	{
		return $this->taxRates;
	}

	public function addExcise(Excise $value)
	{
		$this->excises[] = $value;
	}

	public function getExcises()
	{
		return $this->excises;
	}

	public function addAccessory(Accessory $value)
	{
		$this->accessories[] = $value;
	}

	public function getAccessories()
	{
		return $this->accessories;
	}

	public function addAnalog(Analog $value)
	{
		$this->analogs[] = $value;
	}

	public function getAnalogs()
	{
		return $this->analogs;
	}

	public function addProductChar(ProductChar $value)
	{
		$this->productChars[] = $value;
	}

	public function getProductChars()
	{
		return $this->productChars;
	}

	public function addRequisiteValue(RequisiteValue $value)
	{
		$this->requisiteValues[] = $value;
	}

	public function getRequisiteValues()
	{
		return $this->requisiteValues;
	}

	public static function createFrom(Product $product)
	{
		$offer = new static();
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
