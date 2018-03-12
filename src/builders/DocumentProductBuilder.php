<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\DocumentProduct;
use irpsv\commerceml\helpers\DocumentHelper;

class DocumentProductBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		$ret = DocumentProduct::createFrom(
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

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ЦенаЗаЕдиницу");
		if ($value) {
			$ret->setPricePerOne($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Количество");
		if ($value) {
			$ret->setCount($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Сумма");
		if ($value) {
			$ret->setAmount($value->nodeValue);
		}

		$value = (new UnitBuilder($this->element))->build();
		if ($value) {
			$ret->setUnit($value);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "СтранаПроисхождения");
		if ($value) {
			$ret->setCountry($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ГТД");
		if ($value) {
			$ret->setGtd($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Количество");
		if ($value) {
			$ret->setCount($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Налоги");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Налог") as $item) {
				$x = (new DocumentTaxBuilder($item))->build();
				if ($x) {
					$ret->addDocumentTax($x);
				}
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Скидки");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Скидка") as $item) {
				$x = (new DiscountBuilder($item))->build();
				if ($x) {
					$ret->addDiscount($x);
				}
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Склады");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Склад") as $item) {
				$x = (new DocumentStoreBuilder($item))->build();
				if ($x) {
					$ret->addStore($x);
				}
			}
		}

		return $ret;
	}
}
