<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Address;

class AddressParser
{
	protected $model;
	protected $document;

	public function __construct(Address $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse()
	{
		$ret = $this->document->createElement("Адрес");

		$value = $this->model->getPerformance();
		if ($value) {
			$node = $this->document->createElement("Представление", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getComment();
		if ($value) {
			$node = $this->document->createElement("Комментарий", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getAddressFields();
		foreach ($value as $item) {
			$node = (new AddressFieldParser($item, $this->document))->parse();
			if ($node) {
				$ret->appendChild($node);
			}
		}

		return $ret;
	}
}
