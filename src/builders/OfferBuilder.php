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

	public function build(): ?Offer
	{
		$offer = Offer::createFromProduct(
			(new ProductBuilder($this->element))->build()
		);

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Количество");
		if ($value) {
			$ret->setCount($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Цены");
		if ($value) {
			foreach ($value->getElementsByTagName("Цена") as $item) {
				$ret->addPrice(
					(new PriceBuilder($item))->build()
				);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Склад");
		if ($value) {
			foreach ($value->getElementsByTagName("ОстаткиПоСкладам") as $item) {
				$ret->addStoreCount(
					(new StoreCountBuilder($item))->build()
				);
			}
		}

		return $ret;
	}
}
