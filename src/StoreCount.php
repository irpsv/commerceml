<?php

namespace irpsv\commerceml;

class StoreCount extends Model
{
	protected $storeId;
	protected $count;

	public function setStoreId(string $value)
	{
		$this->storeId = $value;
	}

	public function getStoreId()
	{
		return $this->storeId;
	}

	public function setCount(float $value)
	{
		$this->count = $value;
	}

	public function getCount()
	{
		return $this->count;
	}
}
