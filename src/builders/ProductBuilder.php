<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Product;
use irpsv\commerceml\helpers\DocumentHelper;

class ProductBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build(): ?Product
	{
		$ret = new Product();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Ид");
		if ($value) {
			$ret->setId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Штрихкод");
		if ($value) {
			$ret->setId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Артикул");
		if ($value) {
			$ret->setId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Наименование");
		if ($value) {
			$ret->setName($value->nodeValue);
		}
		//
		// $value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "БазоваяЕдиница");
		// if ($value) {
		// 	$ret->setBaseScale(
		// 		(new BaseScaleBuilder($value))->build()
		// 	);
		// }

		// $value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Группы");
		// if ($value) {
		// 	foreach ($value->getElementsByTagName("Ид") as $item) {
		// 		$ret->addGroupId($item->nodeValue);
		// 	}
		// }
		//
		// $value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Описание");
		// if ($value) {
		// 	$ret->setDesc($value->nodeValue);
		// }
		//
		// $value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Картинка");
		// if ($value) {
		// 	$ret->setDesc(
		// 		new Picture($value->nodeValue)
		// 	);
		// }
		//
		// $vendor = (new VendorBuilder($this->element))->build();
		// if ($vendor) {
		// 	$ret->setVendor($vendor);
		// }
		//
		// $value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ЗначенияСвойств");
		// if ($value) {
		// 	foreach ($value->getElementsByTagName("ЗначенияСвойства") as $item) {
		// 		$ret->addPropertyValue(
		// 			(new PropertyValueBuilder($item))->build()
		// 		);
		// 	}
		// }
		//
		// $value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "СтавкиНалогов");
		// if ($value) {
		// 	foreach ($value->getElementsByTagName("СтавкаНалога") as $item) {
		// 		$ret->addTaxRate(
		// 			(new TaxRateBuilder($item))->build()
		// 		);
		// 	}
		// }
		//
		// $value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Акцизы");
		// if ($value) {
		// 	foreach ($value->getElementsByTagName("Акциз") as $item) {
		// 		$ret->addExcise(
		// 			(new ExciseBuilder($item))->build()
		// 		);
		// 	}
		// }

		if ($ret->isEmpty()) {
			return null;
		}
		else {
			return $ret;
		}
	}
}
