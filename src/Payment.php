<?php

namespace irpsv\commerceml;

class Payment extends Model
{
	protected $documentNumber;
	protected $transactionNumber;
	protected $date;
	protected $amount;
	protected $type;
	protected $typeId;

	public function setDocumentNumber(string $value)
	{
		$this->documentNumber = $value;
	}

	public function getDocumentNumber()
	{
		return $this->documentNumber;
	}

	public function setTransactionNumber(string $value)
	{
		$this->transactionNumber = $value;
	}

	public function getTransactionNumber()
	{
		return $this->transactionNumber;
	}

	public function setDate(\DateTime $value)
	{
		$this->date = $value;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function setAmount(float $value)
	{
		$this->amount = $value;
	}

	public function getAmount()
	{
		return $this->amount;
	}

	public function setType(string $value)
	{
		$this->type = $value;
	}

	public function getType()
	{
		return $this->type;
	}

	public function setTypeId(string $value)
	{
		$this->typeId = $value;
	}

	public function getTypeId()
	{
		return $this->typeId;
	}
}
