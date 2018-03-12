<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\TaxRate;

class TaxRateParser
{
	protected $model;
	protected $document;

	public function __construct(TaxRate $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse()
	{
		$ret = $this->document->createElement("СтавкаНалога");

		$value = $this->model->getName();
		if ($value) {
			$node = $this->document->createElement("Наименование", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getRate();
		if ($value) {
			$node = $this->document->createElement("Ставка", $value);
			$ret->appendChild($node);
		}

		return $ret;
	}
}
