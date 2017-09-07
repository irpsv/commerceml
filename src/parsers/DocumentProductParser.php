<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\DocumentProduct;

class DocumentProductParser
{
	protected $model;
	protected $document;

	public function __construct(DocumentProduct $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(): \DOMElement
	{
		$ret = (new ProductParser($this->model, $this->document))->parse();

		$value = $this->model->getCatalogId();
		if ($value) {
			$node = $this->document->createElement("ИдКаталога", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getClassifierId();
		if ($value) {
			$node = $this->document->createElement("ИдКлассификатора", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getPricePerOne();
		if ($value) {
			$value = number_format($value, 2, '.', '');
			$node = $this->document->createElement("ЦенаЗаЕдиницу", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getCount();
		if ($value) {
			$value = number_format($value, 2, '.', '');
			$node = $this->document->createElement("Количество", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getAmount();
		if ($value) {
			$value = number_format($value, 2, '.', '');
			$node = $this->document->createElement("Сумма", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getUnit();
		if ($value) {
			(new UnitParser($value, $this->document))->parse($ret);
		}

		$value = $this->model->getCountry();
		if ($value) {
			$node = $this->document->createElement("СтранаПроисхождения", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getGtd();
		if ($value) {
			$node = $this->document->createElement("ГТД", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getTaxes();
		if ($value) {
			$node = $this->document->createElement("Налоги");
			foreach ($value as $item) {
				$nodeChild = (new TaxParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getDiscounts();
		if ($value) {
			$node = $this->document->createElement("Скидки");
			foreach ($value as $item) {
				$nodeChild = (new DiscountParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getStores();
		if ($value) {
			$node = $this->document->createElement("Склады");
			foreach ($value as $item) {
				$nodeChild = (new StoreParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		// $value = $this->model->getRequisiteValues();
		// if ($value) {
		// 	$node = $this->document->createElement("ДополнительныеЗначенияРеквизитов");
		// 	foreach ($value as $item) {
		// 		$item = (new RequisiteValueParser($item, $this->document))->parse();
		// 		if ($item) {
		// 			$node->appendChild($item);
		// 		}
		// 	}
		// 	$ret->appendChild($node);
		// }

		return $ret;
	}
}
