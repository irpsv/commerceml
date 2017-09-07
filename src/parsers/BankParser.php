<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Bank;

class BankParser
{
	protected $model;
	protected $document;

	public function __construct(Bank $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(): \DOMElement
	{
		$ret = $this->document->createElement("Банк");

		$value = $this->model->getScore();
		if ($value) {
			$node = $this->document->createElement("СчетКорреспондентский", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getName();
		if ($value) {
			$node = $this->document->createElement("Наименование", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getAddress();
		if ($value) {
			$node = (new AddressParser($value, $this->document))->parse();
			if ($node) {
				$ret->appendChild($node);
			}
		}

		$value = $this->model->getContacts();
		if ($value) {
			$node = $this->document->createElement("Контакты");
			foreach ($value as $item) {
				$nodeChild = (new ContactParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getBik();
		if ($value) {
			$node = $this->document->createElement("БИК", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getSwift();
		if ($value) {
			$node = $this->document->createElement("SWIFT", $value);
			$ret->appendChild($node);
		}

		return $ret;
	}
}
