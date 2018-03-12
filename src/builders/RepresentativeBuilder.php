<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Representative;
use irpsv\commerceml\helpers\DocumentHelper;

class RepresentativeBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		$ret = new Representative();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Ид");
		if ($value) {
			$ret->setId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Наименование");
		if ($value) {
			$ret->setName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Комментарий");
		if ($value) {
			$ret->setComment($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Адрес");
		if ($value) {
			$address = (new AddressBuilder($value))->build();
			if ($address) {
				$ret->setAddress($address);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Отношение");
		if ($value) {
			$ret->setRelation($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Контакты");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Контакт") as $item) {
				$contact = (new ContactBuilder($item))->build();
				if ($contact) {
					$ret->addContact($contact);
				}
			}
		}

		if (DocumentHelper::findFirstLevelChildsByTagName($this->element, "ОфициальноеНаименование")) {
			$value = (new RequisitiesOrganisationBuilder($this->element))->build();
			if ($value) {
				$ret->setRequisitiesOrganisation($value);
			}
		}
		else {
			$value = (new RequisitiesIndividualBuilder($this->element))->build();
			if ($value) {
				$ret->setRequisitiesIndividual($value);
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
