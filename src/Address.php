<?php

namespace irpsv\commerceml;

class Address extends Model
{
	protected $performance; // представление
	protected $comment;
	protected $addressFields = [];

	public function setPerformance(string $value)
	{
		$this->performance = $value;
	}

	public function getPerformance()
	{
		return $this->performance;
	}

	public function setComment(string $value)
	{
		$this->comment = $value;
	}

	public function getComment()
	{
		return $this->comment;
	}

	public function addAddressField(AddressField $value)
	{
		$this->addressFields[] = $value;
	}

	public function getAddressFields()
	{
		return $this->addressFields;
	}
}
