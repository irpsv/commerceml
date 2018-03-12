<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\PriceType;
use irpsv\commerceml\helpers\DocumentHelper;

class PriceTypeBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		$ret = new PriceType();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Ид");
		if ($value) {
			$ret->setId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Наименование");
		if ($value) {
			$ret->setName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Валюта");
		if ($value) {
			$ret->setValute(
				(new ValuteBuilder($value))->build()
			);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Описание");
		if ($value) {
			$ret->setDesc($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Налог");
		if ($value) {
			$ret->setTax(
				(new TaxBuilder($value))->build()
			);
		}

		if ($ret->isEmpty()) {
			return null;
		}
		else {
			return $ret;
		}
	}
}
