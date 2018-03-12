<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Contact;

class ContactParser
{
	protected $model;
	protected $document;

	public function __construct(Contact $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse()
	{
		$ret = $this->document->createElement("Контакт");

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

		$value = $this->model->getComment();
		if ($value) {
			$node = $this->document->createElement("Комментарий", $value);
			$ret->appendChild($node);
		}

		return $ret;
	}
}
