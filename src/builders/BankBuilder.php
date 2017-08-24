<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Bank;
use irpsv\commerceml\helpers\DocumentHelper;

class BankBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build(): ?Bank
	{
		$ret = new Bank();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "СчетКорреспондентский");
		if ($value) {
			$ret->setScore($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Наименование");
		if ($value) {
			$ret->setName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "БИК");
		if ($value) {
			$ret->setBik($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "SWIFT");
		if ($value) {
			$ret->setSwift($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Адрес");
		if ($value) {
			$address = (new AddressBuilder($value))->build();
			if ($address) {
				$ret->setAddress($address);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Контакты");
		if ($value) {
			$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Контакт");
			foreach ($value as $item) {
				$contact = (new ContactBuilder($item))->build();
				if ($contact) {
					$ret->addContact($contact);
				}
			}
		}

		if ($ret->isEmpty()) {
			return null;
		}
		else {
			return $ret;
		}
	}
}
