<?php

namespace irpsv\commerceml;

class PriceType extends Model
{
	protected $id;
	protected $name;
	protected $desc;
	protected $valute;
	protected $tax;

	public function setId(string $value)
	{
		$this->id = $value;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setDesc(string $value)
	{
		$this->desc = $value;
	}

	public function getDesc()
	{
		return $this->desc;
	}

	public function setValute(Valute $value)
	{
		$this->valute = $value;
	}

	public function getValute()
	{
		return $this->valute;
	}

	public function setTax(Tax $value)
	{
		$this->tax = $value;
	}

	public function getTax()
	{
		return $this->tax;
	}
}
