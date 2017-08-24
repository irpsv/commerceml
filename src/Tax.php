<?php

class Tax
{
	protected $name;
	protected $isAccounted; // учтено в сумме?
	protected $isExcise; // Акциз?

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setIsAccounted(bool $value)
	{
		$this->isAccounted = $value;
	}

	public function getIsAccounted(): ?bool
	{
		return $this->isAccounted;
	}

	public function setIsExcise(bool $value)
	{
		$this->isExcise = $value;
	}

	public function getIsExcise(): ?bool
	{
		return $this->isExcise;
	}
}
