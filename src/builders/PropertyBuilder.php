<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Property;
use irpsv\commerceml\helpers\DocumentHelper;

class PropertyBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		$ret = new Property();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Ид");
		if ($value) {
			$ret->setId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Наименование");
		if ($value) {
			$ret->setName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Описание");
		if ($value) {
			$ret->setDesc($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Обязательное");
		if ($value) {
			$ret->setIsRequired($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Множественное");
		if ($value) {
			$ret->setIsMany($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ДляТоваров");
		if ($value) {
			$ret->setForProduct($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ДляПредложений");
		if ($value) {
			$ret->setForOffer($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ДляДокументов");
		if ($value) {
			$ret->setForDocument($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ТипЗначений");
		if ($value) {
			$ret->setValueType($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ВариантыЗначений");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Значение") as $item) {
				$ret->addValue($value->nodeValue);
			}
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Справочник") as $item) {
				$ret->addDictionary(
					(new PropertyDictionaryBuilder($item))->build()
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
