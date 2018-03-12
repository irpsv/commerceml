<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Contact;
use irpsv\commerceml\helpers\DocumentHelper;

class ContactBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		$ret = new Contact();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Тип");
		if ($value) {
			$ret->setType($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Значение");
		if ($value) {
			$ret->setValue($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Комментарий");
		if ($value) {
			$ret->setComment($value->nodeValue);
		}

		if ($ret->isEmpty()) {
			return null;
		}
		else {
			return $ret;
		}
	}
}
