<?php

namespace irpsv\commerceml;

/**
 * Пакет предложений
 */
class OfferPackage extends Model
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
	protected $isOnlyChanges;

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

	public function setActiveFrom(\DateTime $value)
	{
		$this->activeFrom = $value;
	}

	public function getActiveFrom()
	{
		return $this->activeFrom;
	}

	public function setActiveTo(\DateTime $value)
	{
		$this->activeTo = $value;
	}

	public function getActiveTo()
	{
		return $this->activeTo;
	}

	public function setDesc(string $value)
	{
		$this->desc = $value;
	}

	public function getDesc()
	{
		return $this->desc;
	}

	public function setOwner(Contragent $value)
	{
		$this->owner = $value;
	}

	public function getOwner()
	{
		return $this->owner;
	}

	public function addPriceType(PriceType $value)
	{
		$this->priceTypes[] = $value;
	}

	public function getPriceTypes()
	{
		return $this->priceTypes;
	}

	public function addStore(Store $value)
	{
		$this->stores[] = $value;
	}

	public function getStores()
	{
		return $this->stores;
	}

	public function addPropertyValue(PropertyValue $value)
	{
		$this->propertyValues[] = $value;
	}

	public function getPropertyValues()
	{
		return $this->propertyValues;
	}

	public function addOffer(Offer $value)
	{
		$this->offers[] = $value;
	}

	public function getOffers()
	{
		return $this->offers;
	}

	public function setIsOnlyChanges(bool $value)
	{
		$this->isOnlyChanges = $value;
	}

	public function getIsOnlyChanges()
	{
		return $this->isOnlyChanges;
	}
}
