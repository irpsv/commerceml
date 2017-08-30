<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\RequisiteValue;

class RequisiteValueParser
{
	protected $model;
	protected $document;

	public function __construct(RequisiteValue $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(): \DOMElement
	{
		$ret = $this->document->createElement("ЗначениеРеквизита");

		$value = $this->model->getName();
		if ($value) {
			$node = $this->document->createElement("Наименование", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getValue();
		if ($value) {
			$node = $this->document->createElement("Значение", $value);
			$ret->appendChild($node);
		}

		return $ret;
	}
}
