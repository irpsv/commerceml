<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\StoreCount;
use irpsv\commerceml\helpers\DocumentHelper;

class StoreCountBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build(): ?StoreCount
	{
		$ret = new StoreCount();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ИдСклада");
		if ($value) {
			$ret->setStoreId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "КоличествоНаСкладе");
		if ($value) {
			$ret->setCount($value->nodeValue);
		}

		if ($ret->isEmpty()) {
			return null;
		}
		else {
			return $ret;
		}
	}
}
