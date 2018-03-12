<?php

namespace irpsv\commerceml;

class Document extends Model
{
	use DocumentTrait;

	protected $id;
	protected $number;
	protected $datetime;
	protected $operation; // ХозОперация
	protected $role;
	protected $valute;
	protected $course;
	protected $amount;
	protected $contragents = [];
	protected $payments = [];
	protected $paymentDate;
	protected $comment;
	protected $products = [];

	public function setId(string $value)
	{
		$this->id = $value;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setNumber(string $value)
	{
		$this->number = $value;
	}

	public function getNumber()
	{
		return $this->number;
	}

	public function setDatetime(\DateTime $value)
	{
		$this->datetime = $value;
	}

	public function getDatetime()
	{
		return $this->datetime;
	}

	public function setOperation(string $value)
	{
		$this->operation = $value;
	}

	public function getOperation()
	{
		return $this->operation;
	}

	public function setRole(string $value)
	{
		$this->role = $value;
	}

	public function getRole()
	{
		return $this->role;
	}

	public function setValute(Valute $value)
	{
		$this->valute = $value;
	}

	public function getValute()
	{
		return $this->valute;
	}

	public function setCourse(float $value)
	{
		$this->course = $value;
	}

	public function getCourse()
	{
		return $this->course;
	}

	public function setAmount(float $value)
	{
		$this->amount = $value;
	}

	public function getAmount()
	{
		return $this->amount;
	}

	public function addContragent(DocumentContragent $value)
	{
		$this->contragents[] = $value;
	}

	public function getContragents()
	{
		return $this->contragents;
	}

	public function addPayment(Payment $value)
	{
		$this->payments[] = $value;
	}

	public function getPayments()
	{
		return $this->payments;
	}

	public function setPaymentDate(\DateTime $value)
	{
		$this->paymentDate = $value;
	}

	public function getPaymentDate()
	{
		return $this->paymentDate;
	}

	public function setComment(string $value)
	{
		$this->comment = $value;
	}

	public function getComment()
	{
		return $this->comment;
	}

	public function addProduct(DocumentProduct $value)
	{
		$this->products[] = $value;
	}

	public function getProducts()
	{
		return $this->products;
	}
}
