<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Price;
use irpsv\commerceml\Valute;
use irpsv\commerceml\helpers\DocumentHelper;

class PriceBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		$ret = new Price();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Представление");
		if ($value) {
			$ret->setPerformance($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ИдТипаЦены");
		if ($value) {
			$ret->setPriceTypeId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ЦенаЗаЕдиницу");
		if ($value) {
			$ret->setPricePerOne($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Валюта");
		if ($value && $value->nodeValue) {
			$ret->setValute(
				new Valute($value->nodeValue)
			);
		}

		$value = (new UnitBuilder($this->element))->build();
		if ($value) {
			$ret->setUnit($value);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "МинКоличество");
		if ($value) {
			$ret->setMinCount($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ИдКаталога");
		if ($value) {
			$ret->setCatalogId($value->nodeValue);
		}

		if ($ret->isEmpty()) {
			return null;
		}
		else {
			return $ret;
		}
	}
}
