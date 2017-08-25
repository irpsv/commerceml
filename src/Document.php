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

	public function getId(): ?string
	{
		return $this->id;
	}

	public function setNumber(string $value)
	{
		$this->number = $value;
	}

	public function getNumber(): ?string
	{
		return $this->number;
	}

	public function setDatetime(\DateTime $value)
	{
		$this->datetime = $value;
	}

	public function getDatetime(): ?\DateTime
	{
		return $this->datetime;
	}

	public function setOperation(string $value)
	{
		$this->operation = $value;
	}

	public function getOperation(): ?string
	{
		return $this->operation;
	}

	public function setRole(string $value)
	{
		$this->role = $value;
	}

	public function getRole(): ?string
	{
		return $this->role;
	}

	public function setValute(Valute $value)
	{
		$this->valute = $value;
	}

	public function getValute(): ?Valute
	{
		return $this->valute;
	}

	public function setCourse(float $value)
	{
		$this->course = $value;
	}

	public function getCourse(): ?float
	{
		return $this->course;
	}

	public function setAmount(float $value)
	{
		$this->amount = $value;
	}

	public function getAmount(): ?float
	{
		return $this->amount;
	}

	public function addContragent(DocumentContragent $value)
	{
		$this->contragents[] = $value;
	}

	public function getContragents(): array
	{
		return $this->contragents;
	}

	public function addPayment(Payment $value)
	{
		$this->payments[] = $value;
	}

	public function getPayments(): array
	{
		return $this->payments;
	}

	public function setPaymentDate(\DateTime $value)
	{
		$this->paymentDate = $value;
	}

	public function getPaymentDate(): ?\DateTime
	{
		return $this->paymentDate;
	}

	public function setComment(string $value)
	{
		$this->comment = $value;
	}

	public function getComment(): ?string
	{
		return $this->comment;
	}

	public function addProduct(DocumentProduct $value)
	{
		$this->products[] = $value;
	}

	public function getProducts(): array
	{
		return $this->products;
	}
}
