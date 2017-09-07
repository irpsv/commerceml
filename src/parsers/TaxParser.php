<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Tax;

class TaxParser
{
	protected $model;
	protected $document;

	public function __construct(Tax $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(): \DOMElement
	{
		$ret = $this->document->createElement("Налог");

		$value = $this->model->getName();
		if ($value) {
			$node = $this->document->createElement("Наименование", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getIsAccounted();
		if (!is_null($value)) {
			$value = $value ? "true" : "false";
			$node = $this->document->createElement("УчтеноВСумме", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getIsExcise();
		if (!is_null($value)) {
			$value = $value ? "true" : "false";
			$node = $this->document->createElement("Акциз", $value);
			$ret->appendChild($node);
		}

		return $ret;
	}
}
