<?php

class Vendor
{
	protected $country;
	protected $brandName;
	protected $ownerBrand;
	protected $manufacturerBrand;

	public function setCountry(string $value)
	{
		$this->country = $value;
	}

	public function getCountry(): ?string
	{
		return $this->country;
	}

	public function setBrandName(string $value)
	{
		$this->brandName = $value;
	}

	public function getBrandName(): ?string
	{
		return $this->brandName;
	}

	public function setOwnerBrand(Contragent $value)
	{
		$this->ownerBrand = $value;
	}

	public function getOwnerBrand(): ?Contragent
	{
		return $this->ownerBrand;
	}

	public function setManufacturerBrand(Contragent $value)
	{
		$this->manufacturerBrand = $value;
	}

	public function getManufacturerBrand(): ?Contragent
	{
		return $this->manufacturerBrand;
	}
}
