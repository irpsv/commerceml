<?php

class AddressField
{
	const TYPE_INDEX = "Почтовый индекс";
	const TYPE_COUNTRY = "Страна";
	const TYPE_REGION = "Регион";
	const TYPE_ARIA = "Район";
	const TYPE_LOCALITY = "Населенный пункт";
	const TYPE_CITY = "Город";
	const TYPE_STREET = "Улица";
	const TYPE_HOUSE = "Дом";
	const TYPE_BODY = "Корпус";
	const TYPE_APARTMENT = "Квартира";

	protected $type;
	protected $value;

	public function setType(string $value)
	{
		$this->type = $value;
	}

	public function getType(): ?string
	{
		return $this->type;
	}

	public function setValue(string $value)
	{
		$this->value = $value;
	}

	public function getValue(): ?string
	{
		return $this->value;
	}
}
