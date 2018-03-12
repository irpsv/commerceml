<?php

namespace irpsv\commerceml;

class DocumentContragent extends Contragent
{
	protected $role;
	protected $score; // РасчетныйСчет
	protected $store; // Склад

	public function setRole(string $value)
	{
		$this->role = $value;
	}

	public function getRole()
	{
		return $this->role;
	}

	public function setScore(Score $value)
	{
		$this->score = $value;
	}

	public function getScore()
	{
		return $this->score;
	}

	public function setStore(Store $value)
	{
		$this->store = $value;
	}

	public function getStore()
	{
		return $this->store;
	}
}
