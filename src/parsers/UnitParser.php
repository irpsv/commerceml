<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Unit;

class UnitParser
{
	protected $model;
	protected $document;

	public function __construct(Unit $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(\DOMElement $ret): \DOMElement
	{
		$value = $this->model->getName();
		if ($value) {
			$node = $this->document->createElement("Единица", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getCoeff();
		if ($value) {
			$node = $this->document->createElement("Коэффициент", $value);
			$ret->appendChild($node);
		}

		return $ret;
	}
}
