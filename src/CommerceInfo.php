<?php

namespace irpsv\commerceml;

class CommerceInfo extends Model
{
	protected $version;
	protected $datetime;
	protected $catalog;
	protected $documents = [];
	protected $classifier;
	protected $offerPackage;

	public function setVersion(string $value)
	{
		$this->version = $value;
	}

	public function getVersion()
	{
		return $this->version;
	}

	public function setDatetime(\DateTime $value)
	{
		$this->datetime = $value;
	}

	public function getDatetime()
	{
		return $this->datetime;
	}

	public function setCatalog(Catalog $value)
	{
		$this->catalog = $value;
	}

	public function getCatalog()
	{
		return $this->catalog;
	}

	public function addDocument(Document $value)
	{
		$this->documents[] = $value;
	}

	public function getDocuments()
	{
		return $this->documents;
	}

	public function setClassifier(Classifier $value)
	{
		$this->classifier = $value;
	}

	public function getClassifier()
	{
		return $this->classifier;
	}

	public function setOfferPackage(OfferPackage $value)
	{
		$this->offerPackage = $value;
	}

	public function getOfferPackage()
	{
		return $this->offerPackage;
	}
}
