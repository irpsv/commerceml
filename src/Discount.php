<?php

namespace irpsv\commerceml;

class Discount extends Model
{
	protected $name;
	protected $amount;
	protected $procent;
	protected $comment;
	protected $isAccounted; // УчтеноВСумме

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setAmount(float $value)
	{
		$this->amount = $value;
	}

	public function getAmount()
	{
		return $this->amount;
	}

	public function setProcent(float $value)
	{
		$this->procent = $value;
	}

	public function getProcent()
	{
		return $this->procent;
	}

	public function setIsAccounted(bool $value)
	{
		$this->isAccounted = $value;
	}

	public function getIsAccounted()
	{
		return $this->isAccounted;
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
