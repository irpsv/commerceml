<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Product;

class ProductParser
{
	protected $model;
	protected $document;

	public function __construct(Product $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(): \DOMElement
	{
		$ret = $this->document->createElement("Товар");

		$value = $this->model->getId();
		if ($value) {
			$node = $this->document->createElement("Ид", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getBarcode();
		if ($value) {
			$node = $this->document->createElement("Штрихкод", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getArticul();
		if ($value) {
			$node = $this->document->createElement("Артикул", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getName();
		if ($value) {
			$node = $this->document->createElement("Наименование", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getBaseScale();
		if ($value) {
			$node = (new BaseScaleParser($value, $this->document))->parse();
			$ret->appendChild($node);
		}

		$value = $this->model->getGroupsIds();
		if ($value) {
			$wrapTag = $this->document->createElement("Группы");
			foreach ($value as $item) {
				$wrapTag->appendChild(
					$this->document->createElement("Ид", $item)
				);
			}
			$ret->appendChild($wrapTag);
		}

		$value = $this->model->getDesc();
		if ($value) {
			$node = $this->document->createElement("Описание", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getPictures();
		if ($value) {
			foreach ($value as $item) {
				$fileName = $item->getFileName();
				if ($fileName) {
					$ret->appendChild(
						$this->document->createElement("Картинка", $fileName)
					);
				}
			}
		}

		$value = $this->model->getPropertyValues();
		if ($value) {
			$wrapTag = $this->document->createElement("ЗначенияСвойств");
			foreach ($value as $item) {
				$node = (new PropertyValueParser($item, $this->document))->parse();
				if ($node) {
					$wrapTag->appendChild($node);
				}
			}
			$ret->appendChild($wrapTag);
		}

		$value = $this->model->getTaxRates();
		if ($value) {
			$wrapTag = $this->document->createElement("СтавкиНалогов");
			foreach ($value as $item) {
				$node = (new TaxRateParser($item, $this->document))->parse();
				if ($node) {
					$wrapTag->appendChild($node);
				}
			}
			$ret->appendChild($wrapTag);
		}

		$value = $this->model->getProductChars();
		if ($value) {
			$wrapTag = $this->document->createElement("ХарактеристикиТовара");
			foreach ($value as $item) {
				$node = (new ProductCharParser($item, $this->document))->parse();
				if ($node) {
					$wrapTag->appendChild($node);
				}
			}
			$ret->appendChild($wrapTag);
		}

		$value = $this->model->getRequisiteValues();
		if ($value) {
			$wrapTag = $this->document->createElement("ЗначенияРеквизитов");
			foreach ($value as $item) {
				$node = (new RequisiteValueParser($item, $this->document))->parse();
				if ($node) {
					$wrapTag->appendChild($node);
				}
			}
			$ret->appendChild($wrapTag);
		}

		return $ret;
	}
}
