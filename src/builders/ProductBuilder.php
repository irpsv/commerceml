<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Product;
use irpsv\commerceml\Picture;
use irpsv\commerceml\helpers\DocumentHelper;

class ProductBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		$ret = new Product();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Ид");
		if ($value) {
			$ret->setId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Штрихкод");
		if ($value) {
			$ret->setBarcode($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Артикул");
		if ($value) {
			$ret->setArticul($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Наименование");
		if ($value) {
			$ret->setName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "БазоваяЕдиница");
		if ($value) {
			$ret->setBaseScale(
				(new BaseScaleBuilder($value))->build()
			);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Группы");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Ид") as $item) {
				$ret->addGroupId($item->nodeValue);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Описание");
		if ($value) {
			$ret->setDesc($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagName($this->element, "Картинка");
		foreach ($value as $item) {
			if ($item->nodeValue) {
				$ret->addPicture(
					new Picture($item->nodeValue)
				);
			}
		}

		//
		// $vendor = (new VendorBuilder($this->element))->build();
		// if ($vendor) {
		// 	$ret->setVendor($vendor);
		// }

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ЗначенияСвойств");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "ЗначенияСвойства") as $item) {
				$ret->addPropertyValue(
					(new PropertyValueBuilder($item))->build()
				);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "СтавкиНалогов");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "СтавкаНалога") as $item) {
				$tax = (new TaxRateBuilder($item))->build();
				if ($tax) {
					$ret->addTaxRate($tax);
				}
			}
		}

		// $value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Акцизы");
		// if ($value) {
		// 	foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Акциз") as $item) {
		// 		$ret->addExcise(
		// 			(new ExciseBuilder($item))->build()
		// 		);
		// 	}
		// }

		// $value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Комплектующие");
		// if ($value) {
		// 	foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Комплектующее") as $item) {
		// 		$tax = (new AccessoryBuilder($item))->build();
		// 		if ($tax) {
		// 			$ret->addAccessory($tax);
		// 		}
		// 	}
		// }
		//
		// $value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Аналоги");
		// if ($value) {
		// 	foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Аналог") as $item) {
		// 		$tax = (new AnalogBuilder($item))->build();
		// 		if ($tax) {
		// 			$ret->addAnalog($tax);
		// 		}
		// 	}
		// }

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ХарактеристикиТовара");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "ХарактеристикаТовара") as $item) {
				$x = (new ProductCharBuilder($item))->build();
				if ($x) {
					$ret->addProductChar($x);
				}
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ЗначенияРеквизитов");
		if ($value) {
			$items = DocumentHelper::findFirstLevelChildsByTagName($value, "ЗначениеРеквизита");
			foreach ($items as $item) {
				$item = (new RequisiteValueBuilder($item))->build();
				if ($item) {
					$ret->addRequisiteValue($item);
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
