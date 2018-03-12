<?php

namespace irpsv\commerceml;

class Score extends Model
{
	protected $number;
	protected $bank;
	protected $bankCorrespondent;
	protected $comment;

	public function setNumber(string $value)
	{
		$this->number = $value;
	}

	public function getNumber()
	{
		return $this->number;
	}

	public function setBank(Bank $value)
	{
		$this->bank = $value;
	}

	public function getBank()
	{
		return $this->bank;
	}

	public function setBankCorrespondent(Bank $value)
	{
		$this->bankCorrespondent = $value;
	}

	public function getBankCorrespondent()
	{
		return $this->bankCorrespondent;
	}

	public function setComment(string $value)
	{
		$this->comment = $value;
	}

	public function getComment()
	{
		return $this->comment;
	}
}
