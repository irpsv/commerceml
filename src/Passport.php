<?php

namespace irpsv\commerceml;

class Passport extends Model
{
	protected $type;
	protected $series;
	protected $number;
	protected $date; // КогдаВыдан
	protected $who; // КемВыдан

	public function setType(string $value)
	{
		$this->type = $value;
	}

	public function getType(): ?string
	{
		return $this->type;
	}

	public function setSeries(string $value)
	{
		$this->series = $value;
	}

	public function getSeries(): ?string
	{
		return $this->series;
	}

	public function setNumber(string $value)
	{
		$this->number = $value;
	}

	public function getNumber(): ?string
	{
		return $this->number;
	}

	public function setDate(\DateTime $value)
	{
		$this->date = $value;
	}

	public function getDate(): ?\DateTime
	{
		return $this->date;
	}

	public function setWho(string $value)
	{
		$this->who = $value;
	}

	public function getWho(): ?string
	{
		return $this->who;
	}
}
