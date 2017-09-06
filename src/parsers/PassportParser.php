<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Passport;

class PassportParser
{
	protected $model;
	protected $document;

	public function __construct(Passport $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(): \DOMElement
	{
		$ret = $this->document->createElement("Удостоврение личности");

		$value = $this->model->getType();
		if ($value) {
			$node = $this->document->createElement("ВидДокумента", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getSeries();
		if ($value) {
			$node = $this->document->createElement("Серия", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getNumber();
		if ($value) {
			$node = $this->document->createElement("Номер", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getDate();
		if ($value) {
			$node = $this->document->createElement("ДатаВыдачи", $value->format('Y-m-d H:i:s'));
			$ret->appendChild($node);
		}

		$value = $this->model->getWho();
		if ($value) {
			$node = $this->document->createElement("КемВыдан", $value);
			$ret->appendChild($node);
		}

		return $ret;
	}
}
