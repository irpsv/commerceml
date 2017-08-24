<?php

namespace irpsv\commerceml;

class Bank extends Model
{
	protected $scor; // счет корреспондентский
	protected $name;
	protected $address;
	protected $contacts = [];
	protected $bik;
	protected $swift;

	public function setScore(string $value)
	{
		$this->score = $value;
	}

	public function getScore(): ?string
	{
		return $this->score;
	}

	public function setName(string $value)
	{
		$this->Name = $value;
	}

	public function getName(): ?string
	{
		return $this->Name;
	}

	public function setAddress(Address $value)
	{
		$this->address = $value;
	}

	public function getAddress(): ?Address
	{
		return $this->address;
	}

	public function addContact(Contact $value)
	{
		$this->contacts[] = $value;
	}

	public function getContacts(): array
	{
		return $this->contacts;
	}

	public function setBik(string $value)
	{
		$this->bik = $value;
		$this->swift = null;
	}

	public function getBik(): ?string
	{
		return $this->bik;
	}

	public function setSwift(string $value)
	{
		$this->bik = null;
		$this->swift = $value;
	}

	public function getSwift(): ?string
	{
		return $this->swift;
	}
}
