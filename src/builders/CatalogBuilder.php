<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Catalog;
use irpsv\commerceml\helpers\DocumentHelper;

class CatalogBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build(): ?Catalog
	{
		$ret = new Catalog();

		$ret->setIsOnlyChanges(
			$this->element->getAttribute("СодержитТолькоИзменения") == "true"
		);

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Ид");
		if ($value) {
			$ret->setId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ИдКлассификатора");
		if ($value) {
			$ret->setClassifierId($value->nodeValue);
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

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Товары");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Товар") as $item) {
				$ret->addProduct(
					(new ProductBuilder($item))->build()
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
