<?php

namespace irpsv\commerceml;

class RequisitiesIndividual extends Model
{
	use HumanInfoTrait;

	protected $fullName;
	protected $appeal; // обращение Например: Г-н, Г-жа, Докт., Проф. и т.д.
	protected $birthday;
	protected $birthplace; // место рождения
	protected $sex;
	protected $inn;
	protected $kpp;
	protected $workPlace;

	public function setFullName(string $value)
	{
		$this->FullName = $value;
	}

	public function getFullName(): ?string
	{
		return $this->FullName;
	}

	public function setAppeal(string $value)
	{
		$this->appeal = $value;
	}

	public function getAppeal(): ?string
	{
		return $this->appeal;
	}

	public function setBirthday(\DateTime $value)
	{
		$this->birthday = $value;
	}

	public function getBirthday(): ?\DateTime
	{
		return $this->birthday;
	}

	public function setBirthplace(string $value)
	{
		$this->birthplace = $value;
	}

	public function getBirthplace(): ?string
	{
		return $this->birthplace;
	}

	public function setSex(string $value)
	{
		$this->sex = $value;
	}

	public function getSex(): ?string
	{
		return $this->sex;
	}

	public function setInn(string $value)
	{
		$this->inn = $value;
	}

	public function getInn(): ?string
	{
		return $this->inn;
	}

	public function setKpp(string $value)
	{
		$this->kpp = $value;
	}

	public function getKpp(): ?string
	{
		return $this->kpp;
	}

	public function setWorkPlace(WorkPlace $value)
	{
		$this->workPlace = $value;
	}

	public function getWorkPlace(): ?WorkPlace
	{
		return $this->workPlace;
	}
}
