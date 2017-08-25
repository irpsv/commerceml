<?php

namespace irpsv\commerceml;

trait DocumentTrait
{
	protected $taxes = [];
	protected $discounts = [];
	protected $stores = [];
	protected $requisiteValues = []; // значения реквизитов

	public function addTax(DocumentTax $value)
	{
		$this->taxes[] = $value;
	}

	public function getTaxes(): array
	{
		return $this->taxes;
	}

	public function addDiscount(Discount $value)
	{
		$this->discounts[] = $value;
	}

	public function getDiscounts(): array
	{
		return $this->discounts;
	}

	public function addStore(Store $value)
	{
		$this->stores[] = $value;
	}

	public function getStores(): array
	{
		return $this->stores;
	}

	public function addRequisiteValue(RequisiteValue $value)
	{
		$this->requisiteValues[] = $value;
	}

	public function getRequisiteValues(): array
	{
		return $this->requisiteValues;
	}
}
