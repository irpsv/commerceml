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

	public function getPerformance(): ?string
	{
		return $this->performance;
	}

	public function setComment(string $value)
	{
		$this->comment = $value;
	}

	public function getComment(): ?string
	{
		return $this->comment;
	}

	public function addAddressField(AddressField $value)
	{
		$this->addressFields[] = $value;
	}

	public function getAddressFields(): array
	{
		return $this->addressFields;
	}
}
