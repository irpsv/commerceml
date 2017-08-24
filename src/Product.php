<?php

namespace irpsv\commerceml;

class Product
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

	public function getId(): ?string
	{
		return $this->id;
	}

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setDesc(string $value)
	{
		$this->desc = $value;
	}

	public function getDesc(): ?string
	{
		return $this->desc;
	}

	public function setBarcode(string $value)
	{
		$this->barcode = $value;
	}

	public function getBarcode(): ?string
	{
		return $this->barcode;
	}

	public function setArticul(string $value)
	{
		$this->articul = $value;
	}

	public function getArticul(): ?string
	{
		return $this->articul;
	}

	public function setBaseScale(BaseScale $value)
	{
		$this->baseScale = $value;
	}

	public function getBaseScale(): ?BaseScale
	{
		return $this->baseScale;
	}

	public function setContragentProductId(string $value)
	{
		$this->contragentProductId = $value;
	}

	public function getContragentProductId(): ?string
	{
		return $this->contragentProductId;
	}

	public function addGroupId(string $value)
	{
		$this->groupsIds[] = $value;
	}

	public function getGroupsIds(): array
	{
		return $this->groupsIds;
	}

	public function addPicture(Picture $value)
	{
		$this->pictures[] = $value;
	}

	public function getPictures(): array
	{
		return $this->pictures;
	}

	public function setVendor(Vendor $value)
	{
		$this->vendor = $value;
	}

	public function getVendor(): ?Vendor
	{
		return $this->vendor;
	}

	public function addPropertyValue(PropertyValue $value)
	{
		$this->propertyValues[] = $value;
	}

	public function getPropertyValues(): array
	{
		return $this->propertyValues;
	}

	public function addTaxRate(TaxRate $value)
	{
		$this->taxRates[] = $value;
	}

	public function getTaxRates(): array
	{
		return $this->taxRates;
	}

	public function addExcise(Excise $value)
	{
		$this->excises[] = $value;
	}

	public function getExcises(): array
	{
		return $this->excises;
	}

	public function addAccessory(Accessory $value)
	{
		$this->accessories[] = $value;
	}

	public function getAccessories(): array
	{
		return $this->accessories;
	}

	public function addAnalog(Analog $value)
	{
		$this->analogs[] = $value;
	}

	public function getAnalogs(): array
	{
		return $this->analogs;
	}

	public function addProductChar(ProductChar $value)
	{
		$this->productChars[] = $value;
	}

	public function getProductChars(): array
	{
		return $this->productChars;
	}

	public function addRequisiteValue(RequisiteValue $value)
	{
		$this->requisiteValues[] = $value;
	}

	public function getRequisiteValues(): array
	{
		return $this->requisiteValues;
	}
}
