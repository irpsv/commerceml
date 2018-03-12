<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Classifier;
use irpsv\commerceml\helpers\DocumentHelper;

class ClassifierBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		$ret = new Classifier();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Ид");
		if ($value) {
			$ret->setId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Наименование");
		if ($value) {
			$ret->setName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Владелец");
		if ($value) {
			$ret->setOwner(
				(new ContragentBuilder($value))->build()
			);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Описание");
		if ($value) {
			$ret->setDesc($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Группы");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Группа") as $item) {
				$ret->addGroup(
					(new GroupBuilder($item))->build()
				);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Свойства");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Свойство") as $item) {
				$ret->addProperty(
					(new PropertyBuilder($item))->build()
				);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ТипыЦен");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "ТипЦены") as $item) {
				$ret->addPriceType(
					(new PriceTypeBuilder($item))->build()
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
