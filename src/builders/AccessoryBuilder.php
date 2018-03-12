<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Accessory;
use irpsv\commerceml\helpers\DocumentHelper;

class AccessoryBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		$ret = Accessory::createFrom(
			(new ProductBuilder($this->element))->build()
		);

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ИдКаталога");
		if ($value) {
			$ret->setCatalogId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ИдКлассификатора");
		if ($value) {
			$ret->setClassifierId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Количество");
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
