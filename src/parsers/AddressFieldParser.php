<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\AddressField;

class AddressFieldParser
{
	protected $model;
	protected $document;

	public function __construct(AddressField $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse()
	{
		$ret = $this->document->createElement("АдресноеПоле");

		$value = $this->model->getType();
		if ($value) {
			$node = $this->document->createElement("Тип", $value);
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
