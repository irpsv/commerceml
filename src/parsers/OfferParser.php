<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Offer;

class OfferParser
{
	protected $model;
	protected $document;

	public function __construct(Offer $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(): \DOMElement
	{
		$ret = (new ProductParser($this->model, $this->document))->parse();

		$value = $this->model->getPrices();
		if ($value) {
			$node = $this->document->createElement("Цены");
			foreach ($value as $item) {
				$item = (new PriceParser($item, $this->document))->parse();
				if ($item) {
					$node->appendChild($item);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getCount();
		if ($value) {
			$node = $this->document->createElement("Количество", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getStoreCounts();
		if ($value) {
			$node = $this->document->createElement("Склад");
			foreach ($value as $item) {
				$item = (new StoreCountParser($item, $this->document))->parse();
				if ($item) {
					$node->appendChild($item);
				}
			}
			$ret->appendChild($node);
		}

		return $ret;
	}
}
