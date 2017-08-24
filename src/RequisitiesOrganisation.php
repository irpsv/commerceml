<?php

namespace irpsv\commerceml;

class RequisitiesOrganisation
{
	protected $name;
	protected $address;
	protected $activity; // ОсновнойВидДеятельности
	protected $inn;
	protected $kpp;
	protected $egrpo;
	protected $okved;
	protected $okdp;
	protected $okopf;
	protected $okfs;
	protected $okpo;
	protected $dateRegister;
	protected $head; // Руководитель
	protected $scores = [];

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setAddress(Address $value)
	{
		$this->address = $value;
	}

	public function getAddress(): ?Address
	{
		return $this->address;
	}

	public function setActivity(string $value)
	{
		$this->activity = $value;
	}

	public function getActivity(): ?string
	{
		return $this->activity;
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

	public function setEgrpo(string $value)
	{
		$this->egrpo = $value;
	}

	public function getEgrpo(): ?string
	{
		return $this->egrpo;
	}

	public function setOkved(string $value)
	{
		$this->okved = $value;
	}

	public function getOkved(): ?string
	{
		return $this->okved;
	}

	public function setOkdp(string $value)
	{
		$this->okdp = $value;
	}

	public function getOkdp(): ?string
	{
		return $this->okdp;
	}

	public function setOkopf(string $value)
	{
		$this->okopf = $value;
	}

	public function getOkopf(): ?string
	{
		return $this->okopf;
	}

	public function setOkfs(string $value)
	{
		$this->okfs = $value;
	}

	public function getOkfs(): ?string
	{
		return $this->okfs;
	}

	public function setOkpo(string $value)
	{
		$this->okpo = $value;
	}

	public function getOkpo(): ?string
	{
		return $this->okpo;
	}

	public function setDateRegister(\DateTime $value)
	{
		$this->dateRegister = $value;
	}

	public function getDateRegister(): ?\DateTime
	{
		return $this->dateRegister;
	}

	public function setHead(OrganisationHead $value)
	{
		$this->head = $value;
	}

	public function getHead(): ?OrganisationHead
	{
		return $this->head;
	}

	public function addScore(Score $value)
	{
		$this->scores[] = $value;
	}

	public function getScores(): array
	{
		return $this->scores;
	}
}
