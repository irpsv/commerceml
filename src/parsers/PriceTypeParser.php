<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\PriceType;

class PriceTypeParser
{
	protected $model;
	protected $document;

	public function __construct(PriceType $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse()
	{
		$ret = $this->document->createElement("ТипЦены");

		$value = $this->model->getId();
		if ($value) {
			$node = $this->document->createElement("Ид", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getName();
		if ($value) {
			$node = $this->document->createElement("Наименование", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getValute();
		if ($value) {
			$node = $this->document->createElement("Валюта", $value->getCode());
			$ret->appendChild($node);
		}

		$value = $this->model->getDesc();
		if ($value) {
			$node = $this->document->createElement("Описание", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getTax();
		if ($value) {
			$node = (new TaxParser($value, $this->document))->parse();
			if ($node) {
				$ret->appendChild($node);
			}
		}

		return $ret;
	}
}
