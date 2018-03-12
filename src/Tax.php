<?php

namespace irpsv\commerceml;

class Tax extends Model
{
	protected $name;
	protected $isAccounted; // учтено в сумме?
	protected $isExcise; // Акциз?

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setIsAccounted(bool $value)
	{
		$this->isAccounted = $value;
	}

	public function getIsAccounted()
	{
		return $this->isAccounted;
	}

	public function setIsExcise(bool $value)
	{
		$this->isExcise = $value;
	}

	public function getIsExcise()
	{
		return $this->isExcise;
	}
}
