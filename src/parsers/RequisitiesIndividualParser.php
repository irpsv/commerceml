<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\RequisitiesIndividual;

class RequisitiesIndividualParser
{
	protected $model;
	protected $document;

	public function __construct(RequisitiesIndividual $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(\DOMElement $ret): \DOMElement
	{
		$value = $this->model->getFullName();
		if ($value) {
			$node = $this->document->createElement("ПолноеНаименование", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getAppeal();
		if ($value) {
			$node = $this->document->createElement("Обращение", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getSecondName();
		if ($value) {
			$node = $this->document->createElement("Фамилия", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getFirstName();
		if ($value) {
			$node = $this->document->createElement("Имя", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getThirdName();
		if ($value) {
			$node = $this->document->createElement("Отчество", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getBirthday();
		if ($value) {
			$node = $this->document->createElement("ДатаРождения", $value->format('Y-m-d H:i:s'));
			$ret->appendChild($node);
		}

		$value = $this->model->getBirthplace();
		if ($value) {
			$node = (new AddressParser($value, $this->document))->parse();
			if ($node) {
				$node = $this->document->createElement("МестоРождения", $node->nodeValue);
				$ret->appendChild($node);
			}
		}

		$value = $this->model->getSex();
		if ($value) {
			$node = $this->document->createElement("Пол", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getInn();
		if ($value) {
			$node = $this->document->createElement("ИНН", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getKpp();
		if ($value) {
			$node = $this->document->createElement("КПП", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getPassport();
		if ($value) {
			$node = (new PassportParser($value, $this->document))->parse();
			if ($node) {
				$ret->appendChild($node);
			}
		}

		$value = $this->model->getAddress();
		if ($value) {
			$node = (new AddressParser($value, $this->document))->parse();
			if ($node) {
				$node = $this->document->createElement("АдресРегистрации", $node->nodeValue);
				$ret->appendChild($node);
			}
		}

		return $ret;
	}
}
