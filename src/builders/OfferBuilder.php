<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Offer;
use irpsv\commerceml\helpers\DocumentHelper;

class OfferBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		$ret = Offer::createFrom(
			(new ProductBuilder($this->element))->build()
		);

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Количество");
		if ($value) {
			$ret->setCount($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Цены");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Цена") as $item) {
				$ret->addPrice(
					(new PriceBuilder($item))->build()
				);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagName($this->element, "Склад");
		foreach ($value as $item) {
			$item = (new StoreCountBuilder($item))->build();
			if ($item) {
				$ret->addStoreCount($item);
			}
		}

		return $ret;
	}
}
