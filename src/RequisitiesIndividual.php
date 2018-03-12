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

	public function getFullName()
	{
		return $this->FullName;
	}

	public function setAppeal(string $value)
	{
		$this->appeal = $value;
	}

	public function getAppeal()
	{
		return $this->appeal;
	}

	public function setBirthday(\DateTime $value)
	{
		$this->birthday = $value;
	}

	public function getBirthday()
	{
		return $this->birthday;
	}

	public function setBirthplace(Address $value)
	{
		$this->birthplace = $value;
	}

	public function getBirthplace()
	{
		return $this->birthplace;
	}

	public function setSex(string $value)
	{
		$this->sex = $value;
	}

	public function getSex()
	{
		return $this->sex;
	}

	public function setInn(string $value)
	{
		$this->inn = $value;
	}

	public function getInn()
	{
		return $this->inn;
	}

	public function setKpp(string $value)
	{
		$this->kpp = $value;
	}

	public function getKpp()
	{
		return $this->kpp;
	}

	public function setWorkPlace(WorkPlace $value)
	{
		$this->workPlace = $value;
	}

	public function getWorkPlace()
	{
		return $this->workPlace;
	}
}
