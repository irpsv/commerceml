<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\OfferPackage;
use irpsv\commerceml\helpers\DocumentHelper;

class OfferPackageBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build(): ?OfferPackage
	{
		$ret = new OfferPackage();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Ид");
		if ($value) {
			$ret->setId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Наименование");
		if ($value) {
			$ret->setName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ИдКаталога");
		if ($value) {
			$ret->setCatalogId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ИдКлассификатора");
		if ($value) {
			$ret->setClassifierId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ДействительноС");
		if ($value) {
			$ret->setActiveFrom(
				new \DateTime($value->nodeValue)
			);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ДействительноДо");
		if ($value) {
			$ret->setActiveTo(
				new \DateTime($value->nodeValue)
			);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Описание");
		if ($value) {
			$ret->setDesc($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Владелец");
		if ($value) {
			$ret->setOwner(
				(new ContragentBuilder($value))->build()
			);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ТипыЦен");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "ТипЦены") as $item) {
				$ret->addPriceType(
					(new PriceTypeBuilder($item))->build()
				);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Склады");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Склад") as $item) {
				$ret->addStore(
					(new StoreBuilder($item))->build()
				);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ЗначенияСвойств");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "ЗначенияСвойства") as $item) {
				$ret->addPropertyValue(
					(new PropertyValueBuilder($item))->build()
				);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Предложения");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Предложение") as $item) {
				$ret->addOffer(
					(new OfferBuilder($item))->build()
				);
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
