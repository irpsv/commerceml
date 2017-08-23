<?php

namespace irpsv\commerceml\docs;

class CommerceInfo
{
	public $version;
	public $datetime;
	protected $catalog;
	protected $classifier;
	protected $offerPackage;

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
