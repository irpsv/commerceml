<?php

namespace irpsv\commerceml;

/**
 * Пакет предложений
 */
class OfferPackage
{
	protected $id;
	protected $name;
	protected $catalogId;
	protected $classifierId;
	protected $activeFrom;
	protected $activeTo;
	protected $desc;
	protected $owner;
	protected $priceTypes = [];
	protected $stores = [];
	protected $propertyValues = [];
	protected $offers = [];

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

	public function setActiveFrom(\DateTime $value)
	{
		$this->activeFrom = $value;
	}

	public function getActiveFrom(): ?\DateTime
	{
		return $this->activeFrom;
	}

	public function setActiveTo(\DateTime $value)
	{
		$this->activeTo = $value;
	}

	public function getActiveTo(): ?\DateTime
	{
		return $this->activeTo;
	}

	public function setDesc(string $value)
	{
		$this->desc = $value;
	}

	public function getDesc(): ?string
	{
		return $this->desc;
	}

	public function setOwner(Contragent $value)
	{
		$this->owner = $value;
	}

	public function getOwner(): ?Contragent
	{
		return $this->owner;
	}

	public function addPriceType(PriceType $value)
	{
		$this->priceTypes[] = $value;
	}

	public function getPriceTypes(): array
	{
		return $this->priceTypes;
	}

	public function addStore(Store $value)
	{
		$this->stores[] = $value;
	}

	public function getStores(): array
	{
		return $this->stores;
	}

	public function addPropertyValue(PropertyValue $value)
	{
		$this->propertyValues[] = $value;
	}

	public function getPropertyValues(): array
	{
		return $this->propertyValues;
	}

	public function addOffer(Offer $value)
	{
		$this->offers[] = $value;
	}

	public function getOffers(): array
	{
		return $this->offers;
	}
}
