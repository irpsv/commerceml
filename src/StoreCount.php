<?php

class StoreCount
{
	protected $storeId;
	protected $count;

	public function setStoreId(string $value)
	{
		$this->storeId = $value;
	}

	public function getStoreId(): ?string
	{
		return $this->storeId;
	}

	public function setCount(float $value)
	{
		$this->count = $value;
	}

	public function getCount(): ?float
	{
		return $this->count;
	}
}
