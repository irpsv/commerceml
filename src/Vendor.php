<?php

namespace irpsv\commerceml;

class Vendor extends Model
{
	protected $country;
	protected $brandName;
	protected $ownerBrand;
	protected $manufacturerBrand;

	public function setCountry(string $value)
	{
		$this->country = $value;
	}

	public function getCountry()
	{
		return $this->country;
	}

	public function setBrandName(string $value)
	{
		$this->brandName = $value;
	}

	public function getBrandName()
	{
		return $this->brandName;
	}

	public function setOwnerBrand(Contragent $value)
	{
		$this->ownerBrand = $value;
	}

	public function getOwnerBrand()
	{
		return $this->ownerBrand;
	}

	public function setManufacturerBrand(Contragent $value)
	{
		$this->manufacturerBrand = $value;
	}

	public function getManufacturerBrand()
	{
		return $this->manufacturerBrand;
	}
}
