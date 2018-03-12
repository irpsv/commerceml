<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Price;

class PriceParser
{
	protected $model;
	protected $document;

	public function __construct(Price $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse()
	{
		$ret = $this->document->createElement("Цена");

		$value = $this->model->getPerformance();
		if ($value) {
			$node = $this->document->createElement("Представление", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getPriceTypeId();
		if ($value) {
			$node = $this->document->createElement("ИдТипаЦены", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getPricePerOne();
		if ($value) {
			$node = $this->document->createElement("ЦенаЗаЕдиницу", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getValute();
		if ($value) {
			$node = $this->document->createElement("Валюта", $value->getCode());
			$ret->appendChild($node);
		}

		$value = $this->model->getUnit();
		if ($value) {
			(new UnitParser($value, $this->document))->parse($ret);
		}

		$value = $this->model->getMinCount();
		if ($value) {
			$node = $this->document->createElement("МинКоличество", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getCatalogId();
		if ($value) {
			$node = $this->document->createElement("ИдКаталога", $value);
			$ret->appendChild($node);
		}

		return $ret;
	}
}
