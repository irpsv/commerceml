<?php

namespace irpsv\commerceml;

class Accessory extends Product
{
	protected $catalogId;
	protected $classifierId;
	protected $count;

	public function setCatalogId(string $value)
	{
		$this->catalogId = $value;
	}

	public function getCatalogId(): ?string
	{
		return $this->catalogId;
	}

	public function setClassifierId(string $value)
	{
		$this->classifierId = $value;
	}

	public function getClassifierId(): ?string
	{
		return $this->classifierId;
	}

	public function setCount(int $value)
	{
		$this->count = $value;
	}

	public function getCount(): ?int
	{
		return $this->count;
	}
}
