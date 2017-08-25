<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\RequisitiesOrganisation;
use irpsv\commerceml\helpers\DocumentHelper;

class RequisitiesOrganisationBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build(): ?RequisitiesOrganisation
	{
		$ret = new RequisitiesOrganisation();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ОфициальноеНаименование");
		if ($value) {
			$ret->setName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ЮридическийАдрес");
		if ($value) {
			$address = (new AddressBuilder($value))->build();
			if ($address) {
				$ret->setAddress($address);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ИНН");
		if ($value) {
			$ret->setInn($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "КПП");
		if ($value) {
			$ret->setKpp($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ОсновнойВидДеятельности");
		if ($value) {
			$ret->setActivity($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ЕГРПО");
		if ($value) {
			$ret->setEgrpo($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ОКВЭД");
		if ($value) {
			$ret->setOkved($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ОКДП");
		if ($value) {
			$ret->setOkdp($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ОКОПФ");
		if ($value) {
			$ret->setOkopf($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ОКФС");
		if ($value) {
			$ret->setOkfs($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ОКПО");
		if ($value) {
			$ret->setOkpo($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ДатаРегистрации");
		if ($value) {
			$ret->setDateRegister(
				new \DateTime($value->nodeValue)
			);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Руководитель");
		if ($value) {
			$head = (new OrganisationHeadBuilder($value))->build();
			if ($head) {
				$ret->setHead($head);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "РасчетныеСчета");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "РасчетныйСчет") as $item) {
				$score = (new ScoreBuilder($item))->build();
				if ($score) {
					$ret->addScore($score);
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
