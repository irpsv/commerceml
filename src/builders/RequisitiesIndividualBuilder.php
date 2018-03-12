<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\RequisitiesIndividual;
use irpsv\commerceml\helpers\DocumentHelper;

class RequisitiesIndividualBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		$ret = new RequisitiesIndividual();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ПолноеНаименование");
		if ($value) {
			$ret->setFullName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Обращение");
		if ($value) {
			$ret->setAppeal($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Фамилия");
		if ($value) {
			$ret->setSecondName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Имя");
		if ($value) {
			$ret->setFirstName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Отчество");
		if ($value) {
			$ret->setThirdName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ДатаРождения");
		if ($value) {
			$ret->setBirthday(
				new \DateTime($value->nodeValue)
			);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "МестоРождения");
		if ($value) {
			$ret->setBirthplace($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Пол");
		if ($value) {
			$ret->setSex($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ИНН");
		if ($value) {
			$ret->setInn($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "КПП");
		if ($value) {
			$ret->setKpp($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "УдостоверениеЛичности");
		if ($value) {
			$x = (new PassportBuilder($value))->build();
			if ($x) {
				$ret->setPassport($x);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "АдресРегистрации");
		if ($value) {
			$x = (new AddressBuilder($value))->build();
			if ($x) {
				$ret->setAddress($x);
			}
		}

		// $value = (new WorkPlaceBuilder($this->element))->build();
		// if ($value) {
		// 	$ret->setWorkPlace($value->nodeValue);
		// }

		if ($ret->isEmpty()) {
			return null;
		}
		else {
			return $ret;
		}
	}
}
