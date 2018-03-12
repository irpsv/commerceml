<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Address;
use irpsv\commerceml\helpers\DocumentHelper;

class AddressBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		$ret = new Address();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Представление");
		if ($value) {
			$ret->setPerformance($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Комментарий");
		if ($value) {
			$ret->setComment($value->nodeValue);
		}

		foreach ($this->element->getElementsByTagName("АдресноеПоле") as $item) {
			$field = (new AddressFieldBuilder($item))->build();
			if ($field) {
				$ret->addAddressField($field);
			}
		}

		if ($ret->isEmpty()) {
			return null;
		}
		else {
			return $ret;
		}
	}
}
