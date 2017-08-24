<?php

namespace irpsv\commerceml;

class CommerceInfo extends Model
{
	protected $version;
	protected $datetime;
	protected $catalog;
	protected $classifier;
	protected $offerPackage;

	public function setVersion(string $value)
	{
		$this->version = $value;
	}

	public function getVersion(): ?string
	{
		return $this->version;
	}

	public function setDatetime(\DateTime $value)
	{
		$this->datetime = $value;
	}

	public function getDatetime(): ?\DateTime
	{
		return $this->datetime;
	}

	public function setCatalog(Catalog $value)
	{
		$this->catalog = $value;
	}

	public function getCatalog(): ?Catalog
	{
		return $this->catalog;
	}

	public function setClassifier(Classifier $value)
	{
		$this->classifier = $value;
	}

	public function getClassifier(): ?Classifier
	{
		return $this->classifier;
	}

	public function setOfferPackage(OfferPackage $value)
	{
		$this->offerPackage = $value;
	}

	public function getOfferPackage(): ?OfferPackage
	{
		return $this->offerPackage;
	}
}
