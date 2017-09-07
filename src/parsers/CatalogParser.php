<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Catalog;

class CatalogParser
{
	protected $model;
	protected $document;

	public function __construct(Catalog $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(): \DOMElement
	{
		$ret = $this->document->createElement("Каталог");

		$value = $this->model->getIsOnlyChanges();
		if (!is_null($value)) {
			$value = $value ? "true" : "false";
			$ret->setAttribute("СодержитТолькоИзменения", $value);
		}

		$value = $this->model->getId();
		if ($value) {
			$node = $this->document->createElement("Ид", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getClassifierId();
		if ($value) {
			$node = $this->document->createElement("ИдКлассификатора", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getName();
		if ($value) {
			$node = $this->document->createElement("Наименование", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getOwner();
		if ($value) {
			$node = (new ContragentParser($value, $this->document))->parse();
			if ($node) {
				$childs = [];
				foreach ($node->childNodes as $child) {
					$childs[] = $child;
				}

				$node2 = $this->document->createElement("Владелец");
				foreach ($childs as $child) {
					$node2->appendChild($child);
				}
				$ret->appendChild($node2);
			}
		}

		$value = $this->model->getProducts();
		if ($value) {
			$node = $this->document->createElement("Товары");
			foreach ($value as $item) {
				$nodeChild = (new ProductParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getDesc();
		if ($value) {
			$node = $this->document->createElement("Описание", $value);
			$ret->appendChild($node);
		}

		return $ret;
	}
}
