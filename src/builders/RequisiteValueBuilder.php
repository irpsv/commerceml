<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\RequisiteValue;
use irpsv\commerceml\helpers\DocumentHelper;

class RequisiteValueBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		$ret = new RequisiteValue();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Значение");
		if ($value) {
			$ret->setValue($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Наименование");
		if ($value) {
			$ret->setName($value->nodeValue);
		}

		if ($ret->isEmpty()) {
			return null;
		}
		else {
			return $ret;
		}
	}
}
