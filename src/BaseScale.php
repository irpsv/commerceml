<?php

namespace irpsv\commerceml;

class BaseScale extends Model
{
	protected $code;
	protected $name;
	protected $value;
	protected $fullName;
	protected $reduction; // международное сокращение
	protected $reCalcs = []; // пересчет. Могут быть указаны способы пересчета в другие единицы. Указанные способы пересчета следует использовать в случаях несовпадения базовых единиц на одни и те же товары.

	public function setCode(string $value)
	{
		$this->code = $value;
	}

	public function getCode()
	{
		return $this->code;
	}

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setValue(string $value)
	{
		$this->value = $value;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function setFullName(string $value)
	{
		$this->fullName = $value;
	}

	public function getFullName()
	{
		return $this->fullName;
	}

	public function setReduction(string $value)
	{
		$this->reduction = $value;
	}

	public function getReduction()
	{
		return $this->reduction;
	}

	// public function addReCalc(Unit $value)
	// {
	// 	$this->reCalcs[] = $value;
	// }
	//
	// public function getReCalcs()
	// {
	// 	return $this->reCalcs;
	// }
}
