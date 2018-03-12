<?php

namespace irpsv\commerceml;

trait HumanInfoTrait
{
	protected $firstName; // имя
	protected $secondName; // фамилия
	protected $thirdName; // отчество
	protected $passport; // Документ, удостоверяющий личность
	protected $address; // адрес регистрации

	public function setFirstName(string $value)
	{
		$this->firstName = $value;
	}

	public function getFirstName()
	{
		return $this->firstName;
	}

	public function setSecondName(string $value)
	{
		$this->secondName = $value;
	}

	public function getSecondName()
	{
		return $this->secondName;
	}

	public function setThirdName(string $value)
	{
		$this->thirdName = $value;
	}

	public function getThirdName()
	{
		return $this->thirdName;
	}

	public function setPassport(Passport $value)
	{
		$this->passport = $value;
	}

	public function getPassport()
	{
		return $this->passport;
	}

	public function setAddress(Address $value)
	{
		$this->address = $value;
	}

	public function getAddress()
	{
		return $this->address;
	}
}
