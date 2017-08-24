<?php

namespace irpsv\commerceml;

class Property
{
	const TYPE_TIME = "Время";
	const TYPE_NUMBER = "Число";
	const TYPE_STRING = "Строка";
	const TYPE_DICTIONARY = "Справочник";

	protected $id;
	protected $name;
	protected $desc;
	protected $isRequired;
	protected $isMany; // множественное
	protected $forProduct;
	protected $forOffer;
	protected $forDocument;
	protected $valueType;
	protected $values = []; // ТОЛЬКО значения
	protected $dictionaries = []; // ТОЛЬКО справочники

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

	public function setIsRequired(bool $value)
	{
		$this->isRequired = $value;
	}

	public function getIsRequired(): ?bool
	{
		return $this->isRequired;
	}

	public function setIsMany(bool $value)
	{
		$this->isMany = $value;
	}

	public function getIsMany(): ?bool
	{
		return $this->isMany;
	}

	public function setForProduct(bool $value)
	{
		$this->forProduct = $value;
	}

	public function getForProduct(): ?bool
	{
		return $this->forProduct;
	}

	public function setForOffer(bool $value)
	{
		$this->forOffer = $value;
	}

	public function getForOffer(): ?bool
	{
		return $this->forOffer;
	}

	public function setForDocument(bool $value)
	{
		$this->forDocument = $value;
	}

	public function getForDocument(): ?bool
	{
		return $this->forDocument;
	}

	public function setValueType(string $value)
	{
		$this->valueType = $value;
	}

	public function getValueType(): ?string
	{
		return $this->valueType;
	}

	public function addValues(string $value)
	{
		$this->values[] = $value;
	}

	public function getValues(): array
	{
		return $this->values;
	}

	public function addDictionary(PropertyDictionary $value)
	{
		$this->dictionaries[] = $value;
	}

	public function getDictionaries(): array
	{
		return $this->dictionaries;
	}
}
