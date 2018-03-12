<?php

namespace irpsv\commerceml;

class Offer extends Product
{
	protected $prices = [];
	protected $count;
	protected $storeCounts = []; // остаткиПоСкладам

	public function addPrice(Price $value)
	{
		$this->prices[] = $value;
	}

	public function getPrices()
	{
		return $this->prices;
	}

	public function setCount(int $value)
	{
		$this->count = $value;
	}

	public function getCount()
	{
		return $this->count;
	}

	public function addStoreCount(StoreCount $value)
	{
		$this->storeCounts[] = $value;
	}

	public function getStoreCounts()
	{
		return $this->storeCounts;
	}
}
