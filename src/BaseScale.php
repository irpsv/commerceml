<?php

namespace irpsv\commerceml;

class BaseScale
{
	protected $code;
	protected $name;
	protected $fullName;
	protected $reduction; // международное сокращение
	protected $reCalcs = []; // пересчет. Могут быть указаны способы пересчета в другие единицы. Указанные способы пересчета следует использовать в случаях несовпадения базовых единиц на одни и те же товары.

	public function setCode(string $value)
	{
		$this->code = $value;
	}

	public function getCode(): ?string
	{
		return $this->code;
	}

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setFullName(string $value)
	{
		$this->fullName = $value;
	}

	public function getFullName(): ?string
	{
		return $this->fullName;
	}

	public function setReduction(string $value)
	{
		$this->reduction = $value;
	}

	public function getReduction(): ?string
	{
		return $this->reduction;
	}

	public function addReCalc(Unit $value)
	{
		$this->reCalcs[] = $value;
	}

	public function getReCalcs(): array
	{
		return $this->reCalcs;
	}
}
