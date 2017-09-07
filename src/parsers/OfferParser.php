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
		$ret = $this->document->createElement('Предложение');
		$product = (new ProductParser($this->model, $this->document))->parse();
		$childs = [];
		foreach ($product->childNodes as $child) {
			$childs[] = $child;
		}
		foreach ($childs as $child) {
			$ret->appendChild($child);
		}

		$value = $this->model->getPrices();
		if ($value) {
			$node = $this->document->createElement("Цены");
			foreach ($value as $item) {
				$nodeChild = (new PriceParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getCount();
		if (!is_null($value)) {
			$node = $this->document->createElement("Количество", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getStoreCounts();
		if ($value) {
			foreach ($value as $item) {
				$node = (new StoreCountParser($item, $this->document))->parse();
				if ($node) {
					$ret->appendChild($node);
				}
			}
		}

		return $ret;
	}
}
