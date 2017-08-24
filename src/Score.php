<?php

namespace irpsv\commerceml;

class Score
{
	protected $number;
	protected $bank;
	protected $bankCorrespondent;
	protected $comment;

	public function setBank(Bank $value)
	{
		$this->bank = $value;
	}

	public function getBank(): ?Bank
	{
		return $this->bank;
	}

	public function setBankCorrespondent(Bank $value)
	{
		$this->bankCorrespondent = $value;
	}

	public function getBankCorrespondent(): ?Bank
	{
		return $this->bankCorrespondent;
	}

	public function setComment(string $value)
	{
		$this->comment = $value;
	}

	public function getComment(): ?string
	{
		return $this->comment;
	}
}
