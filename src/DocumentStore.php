<?php

namespace irpsv\commerceml;

class DocumentStore extends Store
{
	protected $count;

	public function setCount(float $value)
	{
		$this->count = $value;
	}

	public function getCount()
	{
		return $this->count;
	}

	public static function createFrom(Store $value)
	{
		$ret = new self();
		if ($value->getId()) {
			$ret->setId($value->getId());
		}
		if ($value->getName()) {
			$ret->setName($value->getName());
		}
		if ($value->getComment()) {
			$ret->setComment($value->getComment());
		}
		if ($value->getAddress()) {
			$ret->setAddress($value->getAddress());
		}
		foreach ($value->getContacts() as $item) {
			$ret->addContact($item);
		}
		return $ret;
	}
}
